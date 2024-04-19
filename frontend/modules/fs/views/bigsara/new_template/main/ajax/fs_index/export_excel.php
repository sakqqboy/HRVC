<?php
include_once('../../../config/main_function.php');
include_once('../../../PHPExcel-1.8/Classes/PHPExcel.php');
$secure = "-%ekla!(m09)%1A7";
$connection = connectDB($secure);

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

$executionStartTime = microtime(true);

$branchId = $_GET['branch'];
$startYear = $_GET['year'];

$sql_select = "SELECT financial_start_month FROM branch WHERE branchId = '$branchId' ";
$res_select = mysqli_query($connection, $sql_select)  or die($connection->error);
$row_select = mysqli_fetch_assoc($res_select);
$financial_start_month = $row_select['financial_start_month'];

// สร้าง object ของ Class  PHPExcel  ขึ้นมาใหม่
$objPHPExcel = new PHPExcel();

// กำหนดค่าต่างๆ
$objPHPExcel->getProperties()->setCreator("Company Co., Ltd.");
$objPHPExcel->getProperties()->setLastModifiedBy("Company Co., Ltd.");
$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX ReportQuery Document");
$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX ReportQuery Document");
$objPHPExcel->getProperties()->setDescription("ReportQuery from Company Co., Ltd.");

$sheet = $objPHPExcel->getActiveSheet();
$pageMargins = $sheet->getPageMargins();


// margin is set in inches (0.5cm)
$margin = 0.5 / 2.54;
$pageMargins->setTop($margin);
$pageMargins->setBottom($margin);
$pageMargins->setLeft($margin);
$pageMargins->setRight(0);


$styleHeader = array(
    //'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'ffff00')),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => '#000000')
        )
    ),
    'font'  => array(
        'bold'  => true,
        'size'  => 10,
        'name'  => 'Arial',
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
    )
);

$styleNumber = array(
    //'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'ffff00')),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => '#000000')
        )
    ),
    'font'  => array(
        'size'  => 9,
        'name'  => 'Arial',
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
    )
);

$styleText = array(
    //'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'ffff00')),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => '#000000')
        )
    ),
    'font'  => array(
        'size'  => 9,
        'name'  => 'Arial',
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
    )
);

$styleText_green = array(
    //'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'ffff00')),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => '#000000')
        )
    ),
    'font'  => array(
        'size'  => 9,
        'name'  => 'Arial',
        'color' => array('rgb' => '21BA21'),
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
    )
);

$styleText_red = array(
    //'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'ffff00')),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => '#000000')
        )
    ),
    'font'  => array(
        'size'  => 9,
        'name'  => 'Arial',
        'color' => array('rgb' => 'FF0000'),
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
    )
);

$styleText_blue = array(
    //'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'ffff00')),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => '#000000')
        )
    ),
    'font'  => array(
        'size'  => 9,
        'name'  => 'Arial',
        'color' => array('rgb' => '0000FF'),
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
    )
);

// 'color' => array('rgb' => '32CD32'),
$styleTextCenter = array(
    //'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'ffff00')),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => '#000000')
        )
    ),
    'font'  => array(
        'size'  => 9,
        'name'  => 'Arial',
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
    )
);


$columnCharacter = array(
    'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T',
    'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP',
    'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK',
    'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ'
);

/*------------------------------------------------------------------------------------------------------------------------------*/

// หัวตาราง
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columnCharacter[0] . '2', 'ACCOUNT CODE');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells($columnCharacter[0] . '2:' . $columnCharacter[0] . '3');
$objPHPExcel->getActiveSheet()->getColumnDimension($columnCharacter[0])->setWidth(20);

$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columnCharacter[1] . '2', 'ACCOUNT NAME');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells($columnCharacter[1] . '2:' . $columnCharacter[1] . '3');
$objPHPExcel->getActiveSheet()->getColumnDimension($columnCharacter[1])->setWidth(30);

$startMonth = $financial_start_month;
$columnMonthF = 2;
$columnMonthS = 3;
$columnMonthT = 4;

for ($i = 0; $i < 12; $i++) {
    $currentMonth = ($startMonth + $i - 1) % 12 + 1;
    $currentYear = $startYear + floor(($startMonth + $i - 1) / 12);
    $monthName = date('F', mktime(0, 0, 0, $currentMonth, 1));

    $listData[] = array(
        "month" => $currentMonth,
        "year" => $currentYear,
        "actual_amount" => '',
        "target_amount" => '',
        "next_target_amount" => ''
    );

    $rowCell = 1;

    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columnCharacter[$columnMonthF] .'1', "$currentMonth");
    $objPHPExcel->setActiveSheetIndex(0)->mergeCells($columnCharacter[$columnMonthF] . '1:' . $columnCharacter[$columnMonthF] . '1');
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnCharacter[$columnMonthF])->setWidth(20);

    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columnCharacter[$columnMonthS] .'1', "$currentYear");
    $objPHPExcel->setActiveSheetIndex(0)->mergeCells($columnCharacter[$columnMonthS] . '1:' . $columnCharacter[$columnMonthS] . '1');
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnCharacter[$columnMonthS])->setWidth(20);

    $rowCell = 2;

    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columnCharacter[$columnMonthF] . $rowCell, $monthName . ' ' . $currentYear);
    $objPHPExcel->setActiveSheetIndex(0)->mergeCells($columnCharacter[$columnMonthF] . $rowCell . ':' . $columnCharacter[$columnMonthT] . ($rowCell));
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnCharacter[$columnMonthF])->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnCharacter[$columnMonthS])->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnCharacter[$columnMonthT])->setWidth(20);

    $rowCell = 3;

    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columnCharacter[$columnMonthF] . $rowCell, 'Actual');
    $objPHPExcel->setActiveSheetIndex(0)->mergeCells($columnCharacter[$columnMonthF] . $rowCell . ':' . $columnCharacter[$columnMonthF] . ($rowCell));
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnCharacter[$columnMonthF])->setWidth(20);

    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columnCharacter[$columnMonthS] . $rowCell, 'Target');
    $objPHPExcel->setActiveSheetIndex(0)->mergeCells($columnCharacter[$columnMonthS] . $rowCell . ':' . $columnCharacter[$columnMonthS] . ($rowCell));
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnCharacter[$columnMonthS])->setWidth(20);

    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columnCharacter[$columnMonthT] . $rowCell, 'Next Year Target');
    $objPHPExcel->setActiveSheetIndex(0)->mergeCells($columnCharacter[$columnMonthT] . $rowCell . ':' . $columnCharacter[$columnMonthT] . ($rowCell));
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnCharacter[$columnMonthT])->setWidth(20);

    $columnMonthF += 3;
    $columnMonthS += 3;
    $columnMonthT += 3;
}

$endMonth = $currentMonth;
$endYear = $currentYear;

$objPHPExcel->getActiveSheet()->getStyle($columnCharacter[0] . '1:' . $columnCharacter[37] . ($rowCell))->applyFromArray($styleHeader);

// เนื้อหาตาราง
$rowCell = 4;

$sql = "SELECT a.* FROM tbl_branch_pl_account_code a 
        WHERE a.branchId = '$branchId' ORDER BY a.acc_code ASC ";
$rs = mysqli_query($connection, $sql) or die($connection->error);

while ($row = mysqli_fetch_assoc($rs)) {

    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columnCharacter[0] . $rowCell, $row['acc_code']);
    $objPHPExcel->setActiveSheetIndex(0)->mergeCells($columnCharacter[0] . $rowCell . ':' . $columnCharacter[0] . ($rowCell));

    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columnCharacter[1] . $rowCell, $row['acc_name']);
    $objPHPExcel->setActiveSheetIndex(0)->mergeCells($columnCharacter[1] . $rowCell . ':' . $columnCharacter[1] . ($rowCell));

    $account_id = $row['account_id'];
    $columnMonthF = 2;
    $columnMonthS = 3;
    $columnMonthT = 4;

    $sql_detail = "SELECT *
    FROM tbl_branch_pl_data a 
    WHERE a.account_id = '$account_id' AND ((a.month >= '$startMonth' AND a.year = '$startYear') OR (a.month <= '$endMonth' AND a.year = $endYear))
    ORDER BY a.year ASC, a.month ASC";
    $rs_detail = mysqli_query($connection, $sql_detail) or die($connection->error);

    while ($row_detail = mysqli_fetch_assoc($rs_detail)) {
        foreach ($listData as $key => $value) {
            if ($value['month'] == $row_detail['month'] && $value['year'] == $row_detail['year']) {
                $listData[$key]["actual_amount"] = $row_detail['actual_amount'];
                $listData[$key]["target_amount"] = $row_detail['target_amount'];
                $listData[$key]["next_target_amount"] = $row_detail['next_target_amount'];
            }
        }
    }

    foreach ($listData as $key => $row) {
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columnCharacter[$columnMonthF] . $rowCell, $row['actual_amount']);
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells($columnCharacter[$columnMonthF] . $rowCell . ':' . $columnCharacter[$columnMonthF] . ($rowCell));
        $objPHPExcel->getActiveSheet()->getColumnDimension($columnCharacter[$columnMonthF])->setWidth(20);
        $objPHPExcel->getActiveSheet()->getStyle($columnCharacter[$columnMonthF] . $rowCell)->applyFromArray($styleNumber);

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columnCharacter[$columnMonthS] . $rowCell, $row['target_amount']);
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells($columnCharacter[$columnMonthS] . $rowCell . ':' . $columnCharacter[$columnMonthS] . ($rowCell));
        $objPHPExcel->getActiveSheet()->getColumnDimension($columnCharacter[$columnMonthS])->setWidth(20);
        $objPHPExcel->getActiveSheet()->getStyle($columnCharacter[$columnMonthS] . $rowCell)->applyFromArray($styleNumber);

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($columnCharacter[$columnMonthT] . $rowCell, $row['next_target_amount']);
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells($columnCharacter[$columnMonthT] . $rowCell . ':' . $columnCharacter[$columnMonthT] . ($rowCell));
        $objPHPExcel->getActiveSheet()->getColumnDimension($columnCharacter[$columnMonthT])->setWidth(20);
        $objPHPExcel->getActiveSheet()->getStyle($columnCharacter[$columnMonthT] . $rowCell)->applyFromArray($styleNumber);

        $columnMonthF += 3;
        $columnMonthS += 3;
        $columnMonthT += 3;

        $listData[$key]["actual_amount"] = '';
        $listData[$key]["target_amount"] = '';
        $listData[$key]["next_target_amount"] = '';
    }

    $rowCell++;
}

/*-------------------------------------------------------------------------------------------------------------------------------*/
$objPHPExcel->getActiveSheet()->getStyle($columnCharacter[0] . '4:' . $columnCharacter[37] . ($rowCell - 1))->applyFromArray($styleText);
$objPHPExcel->getActiveSheet()->getRowDimension(1)->setVisible(false);
$objPHPExcel->setActiveSheetIndex(0);

//ตั้งชื่อไฟล์
$file_name = "PL-DATA-" . date("d-m-Y");
//
// Save Excel 2007 file
#echo date('H:i:s') . " Write to Excel2007 format\n";
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
ob_end_clean();
// We'll be outputting an excel file
header('Content-type: application/vnd.ms-excel');
// It will be called file.xls
header('Content-Disposition: attachment;filename="' . $file_name . '.xlsx');

$objWriter->save('php://output');

exit();
