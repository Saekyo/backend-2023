<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
class StudentController extends Controller
{
    public function index()
	{
		$students = Student::all();

		if (!empty($students)) {
			$response = [
				'message' => 'Menampilkan Data Semua Siswa',
				'data' => $students,
			];
			return response()->json($response, 200);
		} else {
			$response = [
				'message' => 'Data tidak ada'
			];
			return response()->json($response, 200);
		}
	}

	public function store(Request $request)
	{

		$student = Student::create($request->all());

		$response = [
			'message' => 'Data Siswa Berhasil Dibuat',
			'data' => $student,
		];

		return response()->json($response, 201);
	}
}
