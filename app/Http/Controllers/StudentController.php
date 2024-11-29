<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\ProjectGroup;
use App\Models\GroupMember;
use App\Models\Propose;
use App\Models\Advisor;

class StudentController extends Controller
{
    // Group Setting
    public function groupIndex()
    {
        // ดึงข้อมูลผู้ใช้ที่ล็อกอินอยู่
        $stdLogin = Auth::guard('students')->user();

        // กรองข้อมูล Student ตาม m_id และ ac_id ของผู้ที่ล็อกอิน
        $Student = Student::with(['academic_year', 'project_group'])
            ->where('ac_id', $stdLogin->ac_id)
            ->where('m_id', $stdLogin->m_id)
            ->orderBy('id', 'asc')
            ->get();

        return view('student.group.index', compact('stdLogin', 'Student'));
    }

    public function groupCreate()
    {
        // ดึงข้อมูลผู้ที่ล็อกอินอยู่
        $stdLogin = Auth::guard('students')->user();

        // กรองเฉพาะนักศึกษาที่มี m_id และ ac_id เดียวกันกับที่ล็อกอิน
        $students = Student::with(['major', 'academic_year', 'project_group'])
            ->where('m_id', $stdLogin->m_id)
            ->where('ac_id', $stdLogin->ac_id)
            ->where('id', '!=', $stdLogin->id) // ยกเว้นผู้ล็อกอิน
            ->whereNull('group_id') // เพิ่มเงื่อนไข group_id เป็น null
            ->orderBy('id', 'asc')
            ->get();

        return view('student.group.create', compact('students', 'stdLogin'));
    }

    // public function groupStore(Request $request)
    // {
    //     // Validate the incoming request
    //     $request->validate([
    //         'students' => 'required|array',
    //         'students.*' => 'exists:students,id',
    //     ]);

    //     // ดึงข้อมูลผู้ใช้ที่ล็อกอิน
    //     $stdLogin = Auth::guard('students')->user();

    //     // Create a new project group with status set to 0
    //     $group = ProjectGroup::create([
    //         'status' => 1, // ค่าเริ่มต้นของสถานะ
    //         'created_at' => now(),
    //         'updated_at' => now(),
    //     ]);

    //     // รวม ID ของผู้ล็อกอินเข้ากับนักศึกษาที่ถูกเลือก
    //     $studentIds = array_merge($request->students, [$stdLogin->id]);

    //     // Update group_id for selected students and the user who is logged in
    //     Student::whereIn('id', $studentIds)->update(['group_id' => $group->id]);

    //     // บันทึกข้อมูลลงใน groupmembers
    //     $groupMembersData = [];
    //     foreach ($studentIds as $studentId) {
    //         $groupMembersData[] = [
    //             'group_id' => $group->id,
    //             's_id' => $studentId,
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ];
    //     }
    //     GroupMember::insert($groupMembersData); // ใช้ insert เพื่อบันทึกข้อมูลหลายแถวพร้อมกัน

    //     return redirect()->route('student.group.index')->with('success', 'Student group created successfully.');
    // }

    public function groupStore(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'students' => 'nullable|array', // Allow students to be null
            'students.*' => 'exists:students,id',
        ]);

        // ดึงข้อมูลผู้ใช้ที่ล็อกอิน
        $stdLogin = Auth::guard('students')->user();

        // Create a new project group with status set to 0
        $group = ProjectGroup::create([
            'status' => 1, // ค่าเริ่มต้นของสถานะ
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // รวม ID ของผู้ล็อกอินเข้ากับนักศึกษาที่ถูกเลือก (ถ้ามี)
        $studentIds = $request->students ? array_merge($request->students, [$stdLogin->id]) : [$stdLogin->id];

        // Update group_id for selected students and the user who is logged in
        Student::whereIn('id', $studentIds)->update(['group_id' => $group->id]);

        // บันทึกข้อมูลลงใน groupmembers
        $groupMembersData = [];
        foreach ($studentIds as $studentId) {
            $groupMembersData[] = [
                'group_id' => $group->id,
                's_id' => $studentId,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        GroupMember::insert($groupMembersData); // ใช้ insert เพื่อบันทึกข้อมูลหลายแถวพร้อมกัน

        return redirect()->route('student.group.index')->with('success', 'Student group created successfully.');
    }

    //End Group Setting



    // Propose Setting
    public function proposeIndex()
    {
        $user = Auth::user(); // ดึงข้อมูลผู้ที่ล็อกอิน
        $userGroupId = $user->group_id; // ดึง group_id ของผู้ที่ล็อกอิน

        // ดึง proposals ที่เกี่ยวข้องกับ group_id ของผู้ใช้งาน
        $proposals = Propose::with('advisor') // โหลดความสัมพันธ์ advisor
            ->where('group_id', $userGroupId) // กรองเฉพาะ group_id ของผู้ที่ล็อกอิน
            ->orderBy('id', 'asc') // เรียงตาม id จากน้อยไปมาก
            ->get();

        // ตรวจสอบว่ามี proposal ที่ status เป็น 1 หรือ 2 หรือไม่
        $hasActiveProposal = Propose::where('group_id', $userGroupId)
            ->whereIn('status', [1, 2]) // ตรวจสอบ status 1 (Waiting for approval) หรือ 2 (Rejected)
            ->exists();

        // ส่งข้อมูลไปยัง View
        return view('student.propose.index', compact('proposals', 'hasActiveProposal'));
    }


    public function proposeCreate()
    {
        $advisors = Advisor::all()
            ->where('a_type', '!=', 'admin');
        // ->orderBy('id', 'asc')
        // ->get();
        return view('student.propose.create', compact('advisors'));
    }

    public function proposeStore(Request $request)
    {
        // ตรวจสอบข้อมูลที่ส่งมา
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'objective' => 'required|string',
            'scope' => 'required|string',
            'tools' => 'nullable|string',
            'a_id' => 'required|exists:advisors,id',
        ]);

        // ดึงค่า group_id ของผู้ใช้ที่ล็อกอิน
        $groupId = Auth::user()->group_id;

        // สร้าง Proposal ใหม่
        Propose::create([
            'title' => $validated['title'],
            'objective' => $validated['objective'],
            'scope' => $validated['scope'],
            'tools' => $validated['tools'],
            'a_id' => $validated['a_id'],
            'group_id' => $groupId, // เก็บ group_id ของผู้ใช้ที่ล็อกอิน
            'status' => 1, // ค่าเริ่มต้น
        ]);

        // Redirect หลังจากบันทึกสำเร็จ
        return redirect()->route('student.propose.create')->with('success', 'Proposal created successfully!');
    }

    public function proposeEdit($id)
    {
        $proposal = Propose::findOrFail($id); // ดึงข้อมูล Proposal
        $advisors = Advisor::all()
            ->where('a_type', '!=', 'admin'); // ดึงข้อมูล Advisor
        return view('student.propose.edit', compact('proposal', 'advisors'));
    }

    public function proposeUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'objective' => 'required|string',
            'scope' => 'required|string',
            'tools' => 'nullable|string',
            'a_id' => 'required|exists:advisors,id',
        ]);

        $proposal = Propose::findOrFail($id);
        $proposal->update(array_merge($validated, ['status' => 1])); // อัปเดตข้อมูลและตั้งค่า status เป็น 1
        return redirect()->route('student.propose.index')->with('success', 'Proposal updated successfully!');
    }
    // End Propose Setting
}
