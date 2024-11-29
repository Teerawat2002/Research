<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Advisor;
use App\Models\Propose;
use App\Models\GroupMember;

class AdvisorController extends Controller
{
    // public function advisorIndex()
    // {
    //     return view('advisor.dashboard');
    // }

    public function dashboard()
    {
        $advisor = Auth::guard('advisors')->user();

        return view('advisor.dashboard', compact('advisor'));
    }

    // Proposal setting
    public function proposeIndex()
    {
        $user = Auth::user(); // ดึงข้อมูลผู้ที่ล็อกอิน
        $advisorId = $user->id; // ดึง id ของผู้ใช้งาน (ซึ่งเป็น Advisor)

        // ดึง proposals ที่เกี่ยวข้องกับ a_id ของผู้ใช้งาน
        $proposals = Propose::with('advisor') // โหลดความสัมพันธ์ advisor
            ->where('a_id', $advisorId) // กรองเฉพาะ a_id ที่ตรงกับ id ของผู้ใช้งาน
            ->orderBy('id', 'asc') // เรียงตาม id จากน้อยไปมาก
            ->get();

        // ตรวจสอบว่ามี proposal ที่ status เป็น 1 หรือ 2 หรือไม่
        $hasActiveProposal = Propose::where('a_id', $advisorId)
            ->whereIn('status', [1, 2]) // ตรวจสอบ status 1 (Waiting for approval) หรือ 2 (Rejected)
            ->exists();

        // dd($proposals->toArray());
        // ส่งข้อมูลไปยัง View
        return view('advisor.propose.index', compact('proposals', 'hasActiveProposal'));
    }

    public function approveView($id)
    {
        // ดึงข้อมูล Proposal
        $proposal = Propose::with('advisor')->findOrFail($id);

        // ดึง group_id จาก proposal
        $groupId = $proposal->group_id;

        // ดึงสมาชิกในกลุ่มจาก group_members
        $groupMembers = GroupMember::with('student') // โหลดความสัมพันธ์ student
            ->where('group_id', $groupId)
            ->get();

        // ส่งข้อมูลไปยัง View
        return view('advisor.propose.approve', compact('proposal', 'groupMembers'));
    }


    public function approve(Request $request, $id)
    {
        $validated = $request->validate([
            'approval' => 'required|string|in:approved,rejected',
            'reason' => 'nullable|string|required_if:approval,rejected',
        ]);

        $proposal = Propose::findOrFail($id);

        $proposal->status = $validated['approval'] === 'approved' ? 0 : 2; // 0 = Approved, 2 = Rejected
        $proposal->comments = $validated['approval'] === 'approved' ? null : $validated['reason']; // ถ้าอนุมัติ comments จะเป็น null

        $proposal->save();

        return redirect()->route('advisor.propose.index')->with('success', 'Proposal updated successfully!');
    }
}
