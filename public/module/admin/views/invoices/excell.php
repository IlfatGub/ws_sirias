<?php

    $excellfile = new PHPExcel();

    $i = 0;


    $header_top = array(
        'font' => array(
            'bold' => true,
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => '000000'),
            'size' => 10,
            'name' => 'Arial'
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        ),
    );


    $header = array(
        'font' => array(
            'bold' => true,
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => '000000'),
            'size' => 10,
            'name' => 'Arial'
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        ),

            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '000000')
                )
            )

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
    $activSheet->setTitle("????????");


    $activSheet->getColumnDimension('A')->setWidth(5);
    $activSheet->getColumnDimension('B')->setWidth(30);
    $activSheet->getColumnDimension('C')->setWidth(25);
    $activSheet->getColumnDimension('D')->setWidth(25);
    $activSheet->getColumnDimension('E')->setWidth(30);
    $activSheet->getColumnDimension('F')->setWidth(15);
    $activSheet->getColumnDimension('G')->setWidth(15);
    $activSheet->getColumnDimension('H')->setWidth(15);

    // ?????????????????????? ?????????? ???? ??????????????????
    $activSheet->mergeCells('A1:H1');
    $activSheet->mergeCells('A2:H2');

    $activSheet->getStyle("A1")->applyFromArray($header_top);
    $activSheet->getStyle("A2")->applyFromArray($header_top);

    $activSheet->setCellValue('A1', "???????????? ????????????-???????????????? ???146 ???? 23.12.2020??.");
    $activSheet->setCellValue('A2', "?????????????????? ????????????????????");

    $activSheet->setCellValue('A4', "???????????????????????? ??????????????????????: ????????????");
    $activSheet->setCellValue('A5', "?????????????????????? ????????????????????: ??????????????????????");

    $activSheet->setCellValue('A7', "??? ??/??");
    $activSheet->setCellValue('B7', "???????????????????????? ??????????????????????");
    $activSheet->setCellValue('C7', "??????????, ???????? ????????????????");
    $activSheet->setCellValue('D7', "???????????????????????? ???????????????????? ??????????????????, ?????????? ????????");
    $activSheet->setCellValue('E7', "??????????, ???????? ??????????????????");
    $activSheet->setCellValue('F7', "????????????????/??????????");
    $activSheet->setCellValue('G7', "???????????????????? ?????????????????????? ???????????????????? ??????????????????");
    $activSheet->setCellValue('H7', "????????????????????");


    $activSheet->getStyle("A7")->applyFromArray($header)->getAlignment()->setWrapText(true);
    $activSheet->getStyle("B7")->applyFromArray($header)->getAlignment()->setWrapText(true);
    $activSheet->getStyle("C7")->applyFromArray($header)->getAlignment()->setWrapText(true);
    $activSheet->getStyle("D7")->applyFromArray($header)->getAlignment()->setWrapText(true);
    $activSheet->getStyle("E7")->applyFromArray($header)->getAlignment()->setWrapText(true);
    $activSheet->getStyle("F7")->applyFromArray($header)->getAlignment()->setWrapText(true);
    $activSheet->getStyle("G7")->applyFromArray($header)->getAlignment()->setWrapText(true);
    $activSheet->getStyle("H7")->applyFromArray($header)->getAlignment()->setWrapText(true);


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


//    Yii::$app->response->sendFile($filepath);


?>


