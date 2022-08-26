<?php

    use app\module\admin\models\Invoices;

    isset($run) ? '' : 'Ничего не выбрано';
$i = 0;
?>

<style type="text/css" media="print">
    body{
        font-size: 9pt !important;
    }
    .inputPrint{
        border: 1px solid black;
    }
    .inputPrint1{
        border: 1px solid black;
    }
    div.no_print {display: none; }
    @media print {
        tr,
        table{
            margin: 0 !important;
            padding: 0 !important;
        }
        td{
            padding: 2px !important;
            border: 1px solid black !important;
        }
        body {
            margin: 0px;
            padding: 0px;
            font-size: 6pt !important;
            font-family: "Times New Roman";
        }
        .font{
            font-size: 6pt !important;
        }
        .inputPrint{
            border: 0px solid black;
            width: 100% !important;
            font-size: 14pt;
            margin: 5px;
        }
        .inputPrint1{
            border: 0px solid black;
            margin: 0px;
            width: 85px !important; ;
        }
        .inputPrint2{
            border: 0px solid black;
            margin: 0px;
            width: 40px !important; ;
        }
        @page  {
            margin: 0cm 0cm 0cm 0cm; /* Отступы для всех левых страниц */
        }
    }

</style>
<!--<div style="ma: -50px 0 0 0 !important;">-->
<!--    <div class="no_print" style="position: fixed; top: 0; left: 10px" >-->
<!--        <button type="button" onclick="this.style='display: none'; print();" class="btn btn-success btn-sm" style="margin: 10px 10px 10px 20px;">Распечатать информацию</button>-->
<!--    </div>-->
<!---->
<!--    <div class="row" style="top:0">-->
<!--        <div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4 text-center font" style="font-size: 14pt;">-->
<!--            РЕЕСТР ПРИЕМА-ПЕРЕДАЧИ <br>-->
<!--            первичных документов-->
<!--        </div>-->
<!--    </div>-->
<!--    --><?php
//    foreach ($model as $item){
//        $org_parent = $item->id_org_parent;
//    }
//    $org = $org_parent ? $org_parent : 'ОАО "СНХРС"';
//    $text = 'Наименование отправителя: ОБИТиС '.$org;
//    $text2 = 'Наменование получателя: Бухгалтерия';
//    ?>
<!--    <input type="text" class="inputPrint font" style="width: 100%; margin: 0; font-size: 10pt;" value='--><?//= $text ?><!--' />-->
<!--    <input type="text" class="inputPrint font" style="width: 100%; margin: 0; font-size: 10pt;" value='--><?//= $text2 ?><!--' />-->
<!--    <br>-->
<!--    <br>-->
<!---->
<!--    <table class="table table-bordered table-condensed">-->
<!--        <tr>-->
<!--            <td style="width: 25px">№ п/п</td>-->
<!--            <td style="width: 150px">Наименование организации/td>-->
<!--            <td style="width: 200px"> Номер, дата договора</td>-->
<!--            <td >Наименование первичного документа, номер дата </td>-->
<!--            <td style="width: 200px">Номер, дата документа</td>-->
<!--            <td style="width: 200px">Оригинал/копия</td>-->
<!--            <td style="width: 100px">Количество экземпляров первичного документа  </td>-->
<!--            <td style="width: 50px"> Примечание </td>-->
<!--        </tr>-->
<!--        --><?php //foreach ($model as $item) {?>
<!--            <tr>-->
<!--                <td>--><?//= ++$i ?><!--</td>-->
<!--                <td>--><?//= $item->id_org ?><!--</td>-->
<!--                <td>--><?//= $item->invoices ?><!-- от --><?//= $item->date ?><!-- </td>-->
<!--                <td>--><?//= $item->id_comment ?><!--</td>-->
<!--                <td>--><?//= $item->document ?><!-- от --><?//= $item->date_document ?><!--</td>-->
<!--                <td>--><?//= isset($item->original) ? 'Копия' : 'Оригинал' ?><!-- </td>-->
<!--                <td> --><?//= $item->count ? $item->count : 1 ?><!-- экз. </td>-->
<!--                <td> </td>-->
<!--            </tr>-->
<!--            --><?php //$executor = $item->id_executor ?>
<!--        --><?php //} ?>
<!--    </table>-->
<!---->
<!---->
<!--    --><?php
//
//    $fio = '<select class="inputPrint1" style="width: 130px">';
//    $fio.= '<option value="volvo">'.$executor.'</option>';
//    $fio.= '<option value="volvo">Клокова А.В.</option>';
//    $fio.= '<option value="volvo">Васильева Э.Р.</option>';
//    $fio.= '</select>';
//
//
//    $tel = '<select class="inputPrint2" style="width: 130px">';
//    $tel.= '<option value="volvo">'.\app\module\admin\models\Executor::getPhone($executor).'</option>';
//    $tel.= '<option value="volvo">33-11</option>';
//    $tel.= '<option value="volvo">33-09</option>';
//    $tel.= '</select>';
//
//    $bottom = "";
//    $bottom.= "<div style='margin: 0 0 0 100px; display: inline-block'>(должность)</div>";
//    $bottom.= "<div style='margin: 0 0 0 100px; display: inline-block '>(подпись)</div>";
//    $bottom.= "<div style='margin: 0 0 0 50px; display: inline-block '>(расшифровка подписи)</div>";
//    $bottom.= "<div style='margin: 0 0 0 100px; display: inline-block '>тел.</div>";
//    ?>
<!--    <br>-->
<!--    <br>-->
<!--    <br>-->
<!--    <div style="float: left;">-->
<!--        <div>-->
<!--            <div style="width: 100px; display: inline-block">Сдал</div>-->
<!--            ________________________________________________________________________________________________________________________________-->
<!--            <div style="margin: 0 0 0 50px; display: inline-block">"_____"  _____--><?//= date('Y') ?><!--г.</div>-->
<!--        </div>-->
<!--        <div>-->
<!--            --><?//= $bottom ?>
<!--        </div>-->
<!--        <br>-->
<!--        <br>-->
<!--        <br>-->
<!--        <div>-->
<!--            <div style="width: 100px; display: inline-block">Принял</div>-->
<!--            _________________________________________________________________________________________________________________________________-->
<!--            <div style="margin: 0 0 0 50px; display: inline-block">"_____"  _____--><?//= date('Y') ?><!--г.</div>-->
<!---->
<!--        </div>-->
<!--        <div>-->
<!--            --><?//= $bottom ?>
<!--        </div>-->
<!--        <br>-->
<!--        <br>-->
<!--        <br>-->
<!--        <div>-->
<!--            <div style="width: 100px; display: inline-block">Принял на обработку</div>-->
<!--            _________________________________________________________________________________________________________________________________-->
<!--            <div style="margin: 0 0 0 50px; display: inline-block">"_____"  _____--><?//= date('Y') ?><!--г.</div>-->
<!--        </div>-->
<!--        <div>-->
<!--            --><?//= $bottom ?>
<!--        </div>-->
<!--    </div>-->
<!---->
<!--</div>-->






<?php

    $excellfile = new PHPExcel();

    $i = 0;


    $header_top = array(
        'font' => array(
            'bold' => true,
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => '000000'),
            'size' => 12,
            'name' => 'Times New Roman'
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        ),
    );

    $header_top = array(
        'font' => array(
            'bold' => true,
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => '000000'),
            'size' => 12,
            'name' => 'Times New Roman'
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        ),
    );


    $header_top_3 = array(
        'font' => array(
            'bold' => true,
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => '000000'),
            'size' => 11,
            'name' => 'Times New Roman'
        ),

    );

    $header_top_2 = array(

        'alignment' => array(
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        ),
    );

    $header = array(
        'font' => array(
//            'bold' => true,
//            'type' => PHPExcel_Style_Fill::FILL_SOLID,
//            'color' => array('rgb' => '000000'),
            'size' => 11,
            'name' => 'Times New Roman'
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        ),

        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
                'color' => array('rgb' => '000000')
            )
        )

    );

    $main = array(
        'font' => array(
            'color' => array('rgb' => '000000'),
            'size' => 12,
            'name' => 'Times New Roman'
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        ),

        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
                'color' => array('rgb' => '000000')
            )
        )

    );


    $main_A = array(
        'font' => array(
            'color' => array('rgb' => '000000'),
            'size' => 12,
            'name' => 'Times New Roman'
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        ),

        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
                'color' => array('rgb' => '000000')
            )
        )

    );

    $bottom = array(
        'font' => array(
            'color' => array('rgb' => '000000'),
            'size' => 11,
            'name' => 'Times New Roman'
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
        ),

    );

    $bottom_2 = array(
        'font' => array(
            'color' => array('rgb' => '000000'),
            'size' => 9,
            'name' => 'Times New Roman'
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        ),

        'borders' => array(
            'top' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => array('rgb' => '000000')
            )
        )
    );


    $bottom_A = array(
        'font' => array(
            'color' => array('rgb' => '000000'),
            'size' => 9,
            'name' => 'Times New Roman'
        ),
//        'alignment' => array(
//            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
//        ),
    );

    $center = array(

        'rotation' => 0,
        'alignment' => array(
            'wrap' => true
        ),
        'shrinkToFit' => false,
        'indent' => 5,
        'font' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        ),
    );
    $border = array(
        'bottom' => array(
            'style' => PHPExcel_Style_Border::BORDER_DASHDOT,
            'color' => array(
                'rgb' => '000000'
            )
        ),
        'top' => array(
            'style' => PHPExcel_Style_Border::BORDER_DASHDOT,
            'color' => array(
                'rgb' => '000000'
            )
        )
    );

    $style = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        )
    );




    $excellfile->createSheet($i);
    $excellfile->setActiveSheetIndex($i);
    $activSheet = $excellfile->getActiveSheet();
    $activSheet->setTitle("НХРС");


    $activSheet->getColumnDimension('A')->setWidth(12);
    $activSheet->getColumnDimension('B')->setWidth(30);
    $activSheet->getColumnDimension('C')->setWidth(30);
    $activSheet->getColumnDimension('D')->setWidth(30);
    $activSheet->getColumnDimension('E')->setWidth(20);
    $activSheet->getColumnDimension('F')->setWidth(20);
    $activSheet->getColumnDimension('G')->setWidth(14);
    $activSheet->getColumnDimension('H')->setWidth(14);
    $activSheet->getColumnDimension('I')->setWidth(25);

    $activSheet->getRowDimension(6)->setRowHeight(25); // для третьей строки
    $activSheet->getRowDimension(7)->setRowHeight(25); // для третьей строки
    $activSheet->getRowDimension(9)->setRowHeight(150); // для третьей строки
    $activSheet->getStyle("A6:H6")->applyFromArray($header_top_2)->getAlignment();
    $activSheet->getStyle("A7:H7")->applyFromArray($header_top_2)->getAlignment();

    // Объединение ячеек по диапазону
    $activSheet->mergeCells('A2:H2');
    $activSheet->mergeCells('A3:H3');
    $activSheet->mergeCells('A4:H4');
    $activSheet->mergeCells('A6:H6');
    $activSheet->mergeCells('A7:H7');

    $activSheet->getStyle("A2")->applyFromArray($header_top);
    $activSheet->getStyle("A3")->applyFromArray($header_top);
    $activSheet->getStyle("A4")->applyFromArray($header_top);

    $activSheet->setCellValue('A2', "Реестр");
    $activSheet->setCellValue('A3', "приема –передачи первичных документов");
    $activSheet->setCellValue('A4', "№ ______ от «____»_____________".date('Y')."г.");

    $activSheet->setCellValue('A6', "Наименование отправителя: УБИТиС");
    $activSheet->setCellValue('A7', "Наменование получателя: Бухгалтерия НХРС");


    $activSheet->setCellValue('A9', "№ п/п");
    $activSheet->setCellValue('B9', "Наименование контрагента-поставщика/подразделения");
    $activSheet->setCellValue('C9', "Номер, дата договора с контрагентом-поставщиком/ иные основания");
    $activSheet->setCellValue('D9', "Наименование первичного документа");
    $activSheet->setCellValue('E9', "Номер первичного документа");
    $activSheet->setCellValue('F9', "Дата первичного документа");
//    $activSheet->setCellValue('G9', "Оригинал / копия");
//    $activSheet->setCellValue('H9', "Количество экземпляров первичного документа");
//    $activSheet->setCellValue('I9', "Примечание / основание возврата");

    $activSheet->setCellValue('G9', "Количество экземпляров первичного документа");
    $activSheet->setCellValue('H9', "Примечание / основание возврата");


    $activSheet->getStyle("A9")->applyFromArray($header)->getAlignment()->setWrapText(true);
    $activSheet->getStyle("B9")->applyFromArray($header)->getAlignment()->setWrapText(true);
    $activSheet->getStyle("C9")->applyFromArray($header)->getAlignment()->setWrapText(true);
    $activSheet->getStyle("D9")->applyFromArray($header)->getAlignment()->setWrapText(true);
    $activSheet->getStyle("E9")->applyFromArray($header)->getAlignment()->setWrapText(true);
    $activSheet->getStyle("F9")->applyFromArray($header)->getAlignment()->setWrapText(true);
    $activSheet->getStyle("G9")->applyFromArray($header)->getAlignment()->setWrapText(true);
    $activSheet->getStyle("H9")->applyFromArray($header)->getAlignment()->setWrapText(true);
//    $activSheet->getStyle("I9")->applyFromArray($header)->getAlignment()->setWrapText(true);

    $a = 9;
    $i = 1;



     foreach ($model as $item) {
         $a++;

         $original = isset($item->original) ? ( $item->original == 1 ? "Оригинал" : "Копия"  ) : '';
         $eczemp = $item->count ? $item->count.' экз' : '1 экз';

         $activSheet->setCellValue('A'.$a, $i++);
         $activSheet->setCellValue('B'.$a, $item->org->name);
         $activSheet->setCellValue('C'.$a, $item->document);
         $activSheet->setCellValue('D'.$a, $item->comment->name);
         $activSheet->setCellValue('E'.$a, $item->invoices);
         $activSheet->setCellValue('F'.$a, Invoices::getDate($item->date));
//         $activSheet->setCellValue('G'.$a, isset($item->original) ? ( $item->original == 1 ? "Оригинал" : "Копия"  ) : '');
         $activSheet->setCellValue('G'.$a, $eczemp . ' - ' . $original);
         $activSheet->setCellValue('H'.$a, $item->note ? $item->note : '');

         $activSheet->getStyle("A".$a)->applyFromArray($main_A)->getAlignment()->setWrapText(true);
         $activSheet->getStyle("B".$a)->applyFromArray($main)->getAlignment()->setWrapText(true);
         $activSheet->getStyle("C".$a)->applyFromArray($main)->getAlignment()->setWrapText(true);
         $activSheet->getStyle("D".$a)->applyFromArray($main)->getAlignment()->setWrapText(true);
         $activSheet->getStyle("E".$a)->applyFromArray($main)->getAlignment()->setWrapText(true);
         $activSheet->getStyle("F".$a)->applyFromArray($main)->getAlignment()->setWrapText(true);
         $activSheet->getStyle("G".$a)->applyFromArray($main)->getAlignment()->setWrapText(true);
         $activSheet->getStyle("H".$a)->applyFromArray($main)->getAlignment()->setWrapText(true);
//         $activSheet->getStyle("I".$a)->applyFromArray($main)->getAlignment()->setWrapText(true);
    }

    $a = $a + 3;
    $activSheet->setCellValue('A'.$a, "Сдал:           _______________________   _____________         _________________________   _________________   «____»___________".date('Y')."г.");
    $activSheet->getStyle("A".$a)->applyFromArray($bottom);

    $a++;

    $activSheet->setCellValue('A'.$a, "                            (должность)                                          (подпись)                                (расшифровка подписи)                               (тел.) ");
    $activSheet->getStyle("A".$a)->applyFromArray($bottom_A);


    $a = $a + 3;
    $activSheet->setCellValue('A'.$a, "Принял:        _______________________   _____________         _________________________   _________________   «____»___________".date('Y')."г.");
    $activSheet->getStyle("A".$a)->applyFromArray($bottom);
    $a++;

    $activSheet->setCellValue('A'.$a, "                            (должность)                                           (подпись)                                (расшифровка подписи)                               (тел.) ");
    $activSheet->getStyle("A".$a)->applyFromArray($bottom_A);


    $a = $a + 3;
    $activSheet->setCellValue('A'.$a, "Принят:        _______________________   _____________         _________________________   _________________   «____»___________".date('Y')."г.");
    $activSheet->getStyle("A".$a)->applyFromArray($bottom);
    $a++;

    $activSheet->setCellValue('A'.$a, "в обработку");
    $activSheet->setCellValue('B'.$a, "(должность)                                           (подпись)                                (расшифровка подписи)                               (тел.) ");
    $activSheet->getStyle("A".$a)->applyFromArray($bottom)->getAlignment();
    $activSheet->getStyle("B".$a)->applyFromArray($bottom_A)->getAlignment();


    $a = $a + 3;
    $activSheet->setCellValue('A'.$a, "Передача документов в бухгалтерию ОП Общества:");
    $activSheet->getStyle("A".$a)->applyFromArray($header_top_3)->getAlignment();



    $a = $a + 3;
    $activSheet->setCellValue('A'.$a, "Принял:        _______________________   _____________         _________________________   _________________   «____»___________".date('Y')."г.");
    $activSheet->getStyle("A".$a)->applyFromArray($bottom);
    $a++;

    $activSheet->setCellValue('A'.$a, "                            (должность)                                          (подпись)                                (расшифровка подписи)                               (тел.) ");
    $activSheet->getStyle("A".$a)->applyFromArray($bottom_A)->getAlignment();




//    $activSheet->setCellValue('A'.$a, "Сдал: ");
//    $activSheet->setCellValue('B'.$a, "Инженер 2 категории");
//    $activSheet->setCellValue('C'.$a, "");
//    $activSheet->setCellValue('D'.$a, "Капошко О.Н.");
//    $activSheet->setCellValue('E'.$a, "");
//    $activSheet->setCellValue('F'.$a, "36-11");
//    $activSheet->setCellValue('G'.$a, "");
//    $activSheet->setCellValue('H'.$a, "2020 год");
    //    $i = 0;
    //    foreach($model as $item) {
    ////
    //        $excellfile->createSheet($i);
    //        $excellfile->setActiveSheetIndex($i);
    //        $activSheet = $excellfile->getActiveSheet();
    //        $activSheet->setTitle($item->name);
    //
    //
    //        $excellfile->getDefaultStyle()->getFont()->setName('Arial');
    //        $excellfile->getDefaultStyle()->getFont()->setSize(8);
    //        $activSheet->getColumnDimension('A')->setWidth(40);
    //        $activSheet->getColumnDimension('B')->setWidth(40);
    //        $activSheet->getColumnDimension('C')->setWidth(20);
    //        $activSheet->getColumnDimension('D')->setWidth(40);
    ////    if (($_GET['id'] == '1') and ( Yii::$app->user->identity->role == 101)){
    ////        $activSheet->getColumnDimension('E')->setWidth(40);
    ////    }
    //
    //
    //        $departList = Depart::find()
    //            ->where(['code_org' => $item->id])
    ////        ->andWhere(['visible' => null])
    //            ->orderBy(['position' => SORT_ASC])
    //            ->all();
    //
    //        $export = Depart::Cats($departList);
    //        Depart::getTree2($export, $activSheet, $header, $border, $center);
    ////    die();
    ////    $a = 1;
    ////    foreach ($export as $depart) {
    //////        echo "<pre>";
    //////        print_r($depart); die();
    //////        if ($_GET['id'] == '0'){
    ////            $activSheet->mergeCells('A'.$a.':D'.$a);
    //////        }else{
    //////            $activSheet->mergeCells('A'.$a.':E'.$a);
    //////        }
    ////        $activSheet->setCellValue('A'.$a,$depart->name);
    ////        $activSheet->getStyle('A'.$a)->applyFromArray($header);
    ////
    ////        $query  = Phonebook::find();
    ////
    ////        $depart->main ? $query->where(['code_depart' => 'SIT00'.$depart->id]) : $query->where(['code_depart' => $depart->code]);
    ////        $number = $query->orderBy(['position' => SORT_ASC])
    ////            ->all();
    ////
    ////        foreach ($number as $numberItem) {
    ////            $a++;
    ////            $activSheet->setCellValue('A'.$a, $numberItem->fio);
    ////            $activSheet->setCellValue('B'.$a, $numberItem->post);
    ////            $activSheet->setCellValue('C'.$a, $numberItem->phone);
    ////            $activSheet->setCellValue('D'.$a, $numberItem->ext);
    //////            if (($_GET['id'] == '1')and ( Yii::$app->user->identity->role == 101)){
    //////                $activSheet->setCellValue('E'.$a, $numberItem->cellular);
    //////            }
    ////            $activSheet->getStyle('A'.$a)->applyFromArray($border);
    ////            $activSheet->getStyle('B'.$a)->applyFromArray($border);
    ////            $activSheet->getStyle('C'.$a)->applyFromArray($center);
    ////            $activSheet->getStyle('D'.$a)->applyFromArray($center);
    //////            if (($_GET['id'] == '1')and ( Yii::$app->user->identity->role == 101)){
    //////                $activSheet->getStyle('E'.$a)->applyFromArray($center);
    //////            }
    ////        }
    ////        $a++;
    ////    }
    //        $i++;
    //    }

    //die();
    //
    $filepath = "download/SNHRS_phone_" . date('Y-m-d') . ".xls";
    $objWriter = PHPExcel_IOFactory::createWriter($excellfile, 'Excel5');
    $objWriter->save($filepath);

    $filepath = "download/export3/sirias_" . date('Y-m-d h-i') . ".xls";
    $objWriter = PHPExcel_IOFactory::createWriter($excellfile, 'Excel5');
    $objWriter->save($filepath);


    Yii::$app->response->sendFile($filepath);


?>

