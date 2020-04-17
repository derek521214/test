<?php



public function runs()
{
    set_time_limit(0);
    $data =[];
    for($i=0;$i<=30000;$i++){ // 这样6万条的话 可能
        $data[] = [
            'id' => $i+1,
            'name' => '用户'.($i+1)
        ];
    }

    $title = [
        [
            '编号', '用户'
        ],
    ];
    $arrData = array_merge($title, $data);
//        var_dump($arrData);die();
    $spreadsheet = new Spreadsheet();

// 设置单元格格式 可以省略
    $styleArray = [
        'font' => [
            'bold' => true,
            'size' => 14,
        ],
    ];
    $spreadsheet->getActiveSheet()->getStyle('A1:B1')->applyFromArray($styleArray);
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(25);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(25);
    $spreadsheet->getActiveSheet()->fromArray($arrData);
//        var_dump($spreadsheet);die();
    $writer = new Xls($spreadsheet);

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');//告诉浏览器输出07Excel文件
    // header('Content-Type:application/vnd.ms-excel');//告诉浏览器将要输出Excel03版本文件
    header('Content-Disposition: attachment;filename=test.xlsx');//告诉浏览器输出浏览器名称
    header('Cache-Control: max-age=0');//禁止缓存

    ob_end_clean();
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
    header("Content-Type:application/force-download");

    header('Content-Type:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

    header("Content-Type:application/octet-stream");
    header("Content-Type:application/download");
    header('Content-Disposition:attachment;filename=test.xls');
    header("Content-Transfer-Encoding:binary");
    $writer->save('php://output');
}

/*public function run()
{
    $spreadsheet = new Spreadsheet();
    try {
        $sheet = $spreadsheet->getActiveSheet();
    } catch (\PhpOffice\PhpSpreadsheet\Exception $e) {
        echo "==PhpSpreadsheet异常==";
        var_dump($e);
        die;
    }
// 按照单元格写入
    $sheet->setCellValue('A1','Hello World');
// 按照行列写入，注意行和列都是从1开始的
    $sheet->setCellValueByColumnAndRow(1,2,'2行1列');

    $writer = new Xls($spreadsheet);
    try {
        ob_end_clean();
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
        header("Content-Type:application/force-download");

        header('Content-Type:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        header("Content-Type:application/octet-stream");
        header("Content-Type:application/download");
        header('Content-Disposition:attachment;filename=test1.xls');
        header("Content-Transfer-Encoding:binary");
        $writer->save('php://output');
        \Yii::$app->end();
    } catch (WriterException $e) {
        echo "==Writer异常==";
        var_dump($e);
        die;
    }
}*/