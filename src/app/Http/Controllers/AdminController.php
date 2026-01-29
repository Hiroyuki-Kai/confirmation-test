<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    public function admin(Request $request)
    {
        $query = Contact::query()
            ->select(
                'id',
                'last_name',
                'first_name',
                'gender',
                'email',
                'tel',
                'address',
                'building',
                'category_id',
                'detail'
            );
        
        // 検索
        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('last_name', 'like', "%{$request->keyword}%")
                ->orWhere('first_name', 'like', "%{$request->keyword}%")
                ->orWhere('email', 'like', "%{$request->keyword}%")
                ->orWhere('detail', 'like', "%{$request->keyword}%");
            });
        }

        //性別
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        //日付
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // 8件ずつページネーション
        $contacts = $query
            ->latest()
            ->paginate(8)
            ->withQueryString(); // ← これ超重要

        return view('admin.admin', compact('contacts'));
    }

    public function delete(Contact $contact)
    {
        return view('admin.delete', compact('contact'));
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admin.admin');
    }

    public function export(Request $request)
    {
        $query = Contact::query()->with('category');

        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->Where('last_name', 'like', "%{$request->keyword}%")
                  ->orWhere('first_name', 'like', "%{$request->keyword}%")
                  ->orWhere('email', 'like', "%{$request->keyword}%")
                  ->orWhere('detail', 'like', "%{$request->keyword}%");
            });
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->latest()->get();

        $response = new StreamedResponse(function () use ($contacts) {
            $handle = fopen('php://output', 'w');

            fwrite($handle, "\xEF\xBB\xBF");

            fputcsv($handle, [
                'お名前',
                '性別',
                'メールアドレス',
                '電話番号',
                '住所',
                '建物名',
                'お問い合わせの種類',
                'お問い合わせ内容',
                '登録日',
            ]);

            foreach ($contacts as $contact) {
                fputcsv($handle, [
                    $contact->full_name,
                    $contact->gender_label,
                    $contact->email,
                    $contact->tel,
                    $contact->address,
                    $contact->building,
                    optional($contact->category)->content,
                    $contact->detail,
                    $contact->created_at->format('Y-m-d h:m:s'),
                ]);
            }

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set(
            'Content-Disposition',
            'attachment; filename="contacts.csv"'
        );

        return $response;
    }
}
