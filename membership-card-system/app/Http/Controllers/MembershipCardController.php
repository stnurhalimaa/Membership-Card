<?php

namespace App\Http\Controllers;

use App\Models\MembershipCard;
use Illuminate\Http\Request;

class MembershipCardController extends Controller
{
    // Menampilkan semua kartu membership
    public function index()
    {
        $cards = MembershipCard::all();
        return view('admin.membership_cards.index', compact('cards'));
    }

    // Menampilkan form untuk membuat kartu baru
    public function create()
    {
        return view('admin.membership_cards.create');
    }

    // Menyimpan kartu baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'joining_date' => 'required|date',
            'expiry_date' => 'nullable|date',
            'membership_number' => 'required|string|unique:membership_cards,membership_number',
        ]);

        MembershipCard::create([
            'name' => $request->name,
            'joining_date' => $request->joining_date,
            'expiry_date' => $request->expiry_date,
            'membership_number' => $request->membership_number,
        ]);

        return redirect()->route('membership_cards.index')->with('success', 'Membership card created successfully!');
    }

    // Menampilkan detail kartu membership tertentu
    public function show($id)
    {
        $card = MembershipCard::findOrFail($id);
        return view('admin.membership_cards.show', compact('card'));
    }

    // Menampilkan form untuk mengedit kartu
    public function edit($id)
    {
        $card = MembershipCard::findOrFail($id);
        return view('admin.membership_cards.edit', compact('card'));
    }

    // Memperbarui kartu yang sudah ada
    public function update(Request $request, $id)
    {
        $card = MembershipCard::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'joining_date' => 'required|date',
            'expiry_date' => 'nullable|date',
            'membership_number' => 'required|string|unique:membership_cards,membership_number,' . $card->id,
        ]);

        $card->update([
            'name' => $request->name,
            'joining_date' => $request->joining_date,
            'expiry_date' => $request->expiry_date,
            'membership_number' => $request->membership_number,
        ]);

        return redirect()->route('membership_cards.index')->with('success', 'Membership card updated successfully!');
    }

    // Menghapus kartu membership
    public function destroy($id)
    {
        $card = MembershipCard::findOrFail($id);
        $card->delete();
        return redirect()->route('membership_cards.index')->with('success', 'Membership card deleted successfully!');
    }
}