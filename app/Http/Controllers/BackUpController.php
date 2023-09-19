<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class BackUpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $backupPath = storage_path('app/backupdata/');
        $files = [];

        if (file_exists($backupPath)) {
            $files = scandir($backupPath);
            $files = array_diff($files, ['.', '..']); // Loại bỏ các thư mục cha và thư mục hiện tại

            // Sắp xếp danh sách các tệp backup theo ngày giờ trong tên tệp
            usort($files, function ($a, $b) use ($backupPath) {
                $aTime = filectime($backupPath . $a);
                $bTime = filectime($backupPath . $b);
                return $bTime - $aTime; // Đảo ngược để tệp gần nhất lên đầu
            });
        }
        $title = 'Dữ liệu';
        return view('tables.backupdata.index-backup', compact('files', 'title'));
    }

    public function downloadBackup($file)
    {
        $backupPath = storage_path('app/backupdata/');
        $filePath = $backupPath . $file;

        if (file_exists($filePath)) {
            $headers = [
                'Content-Type' => 'application/sql',
            ];
            return Response::download($filePath, $file, $headers);
        } else {
            return back()->with('error', 'Tệp backup không tồn tại.');
        }
    }
    public function deleteBackup(Request $request, $file)
    {
        $backupPath = storage_path('app/backupdata/');

        // Kiểm tra xem tệp tồn tại trước khi xóa
        if (file_exists($backupPath . $file)) {
            unlink($backupPath . $file);
            // Hoặc nếu bạn muốn xóa tệp zip nếu tồn tại
            // $zipFile = str_replace('.sql', '.zip', $file);
            // if (file_exists($backupPath . $zipFile)) {
            //     unlink($backupPath . $zipFile);
            // }
        }

        return back()->with('msg', 'Xóa file thành công!');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
