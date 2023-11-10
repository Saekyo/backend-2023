<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Illuminate\Support\Facades\Validator;
class StudentController extends Controller
{
    public function index()
	{
        try {
            $students = Student::all();

            if (count($students) > 0) {
                $response = [
                    'status' => HttpResponse::HTTP_OK,
                    'message' => 'Menampilkan Data Semua Siswa',
                    'data' => $students,
                ];
                return response()->json($response, HttpResponse::HTTP_OK);
            } else {
                $response = [
                    'status' => HttpResponse::HTTP_OK,
                    'message' => 'Data tidak ada'
                ];
                return response()->json($response, HttpResponse::HTTP_OK);
            }
        } catch (\Throwable $th) {
            $response = [
                'status' => HttpResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'Internal Server Error'
            ];
            return response()->json($response, HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
	}

	public function store(Request $request)
	{
        try {
            $this->validate($request, [
                'nama' => 'required',
                'nim' => 'required',
                'email' => 'required|email',
                'jurusan' => 'required',
            ]);
            $student = Student::create($request->all());

            if($student) {
                $response = [
                    'status' => HttpResponse::HTTP_CREATED,
                    'message' => 'Data Siswa Berhasil Dibuat',
                    'data' => $student,
                ];

                return response()->json($response, HttpResponse::HTTP_CREATED);
            } else {
                $response = [
                    'status' => HttpResponse::HTTP_BAD_REQUEST,
                    'message' => 'Gagal Menambahkan Data Siswa'
                ];
                return response()->json($response, HttpResponse::HTTP_BAD_REQUEST);
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            $response = [
                'status' => HttpResponse::HTTP_BAD_REQUEST,
                'message' => 'Data yang dimasukkan tidak valid',
                'errors' => $e->errors()
            ];
            return response()->json($response, HttpResponse::HTTP_BAD_REQUEST);

        } catch (\Throwable $th) {
            $response = [
                'status' => HttpResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'Internal Server Error'
            ];
            return response()->json($response, HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
	}

    public function edit(Request $request, $id)
    {
        try {
            $student = Student::find($id);

            if ($student) {
                $response = [
                    'status' => HttpResponse::HTTP_OK,
                    'message' => 'Menampilkan Data Siswa',
                    'data' => $student,
                ];
                return response()->json($response, HttpResponse::HTTP_OK);
            } else {
                $response = [
                    'status' => HttpResponse::HTTP_NOT_FOUND,
                    'message' => 'Data tidak ada'
                ];
                return response()->json($response, HttpResponse::HTTP_NOT_FOUND);
            }
        } catch (\Throwable $th) {
            $response = [
                'status' => HttpResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'Internal Server Error'
            ];
            return response()->json($response, HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        try {
            $student = Student::find($id);

            if ($student) {
                $student->delete();
                $response = [
                    'status' => HttpResponse::HTTP_OK,
                    'message' => 'Data Siswa Berhasil Dihapus',
                ];
                return response()->json($response, HttpResponse::HTTP_OK);
            } else {
                $response = [
                    'status' => HttpResponse::HTTP_NOT_FOUND,
                    'message' => 'Data tidak ada'
                ];
                return response()->json($response, HttpResponse::HTTP_NOT_FOUND);
            }
        } catch (\Throwable $th) {
            $response = [
                'status' => HttpResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'Internal Server Error'
            ];
            return response()->json($response, HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
