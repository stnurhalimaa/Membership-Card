<?php

namespace App\Http\Controllers;

use App\Models\MembershipCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MembershipCardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cards = MembershipCard::where('name', Auth::user()->name)->get();
        return view('admin.membership_cards.index', compact('cards'));
    }

    public function create()
    {
        return view('admin.membership_cards.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'joining_date' => 'required|date',
            'expiry_date' => 'nullable|date',
            'membership_number' => 'required|string|unique:membership_cards,membership_number',
        ]);

        MembershipCard::create([
            'name' => Auth::user()->name, // Force name to match authenticated user
            'joining_date' => $request->joining_date,
            'expiry_date' => $request->expiry_date,
            'membership_number' => $request->membership_number,
        ]);

        return redirect()->route('dashboard')->with('success', 'Membership card created successfully!');
    }

    public function show($id)
    {
        $card = MembershipCard::findOrFail($id);
        if ($card->name !== Auth::user()->name) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }
        return view('admin.membership_cards.show', compact('card'));
    }

    public function edit($id)
    {
        $card = MembershipCard::findOrFail($id);
        if ($card->name !== Auth::user()->name) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }
        return view('admin.membership_cards.edit', compact('card'));
    }

    public function update(Request $request, $id)
    {
        $card = MembershipCard::findOrFail($id);
        if ($card->name !== Auth::user()->name) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'joining_date' => 'required|date',
            'expiry_date' => 'nullable|date',
            'membership_number' => 'required|string|unique:membership_cards,membership_number,' . $card->id,
        ]);

        $card->update([
            'name' => Auth::user()->name, // Force name to match authenticated user
            'joining_date' => $request->joining_date,
            'expiry_date' => $request->expiry_date,
            'membership_number' => $request->membership_number,
        ]);

        return redirect()->route('dashboard')->with('success', 'Membership card updated successfully!');
    }

    public function destroy($id)
    {
        $card = MembershipCard::findOrFail($id);
        if ($card->name !== Auth::user()->name) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }
        $card->delete();
        return redirect()->route('dashboard')->with('success', 'Membership card deleted successfully!');
    }
}