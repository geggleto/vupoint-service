<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 2016-09-07
 * Time: 1:15 PM
 */

namespace Vupoint\Api;


use PHPExcel_Writer_Excel2007;
use PHPExcel_Writer_Exception;
use Valitron\Validator;
use Vupoint\Data\Payload;

class ExcelService implements ServiceInterface
{
    /** @var \PHPExcel  */
    protected $excel;

    /** @var Validator  */
    protected $validator;

    /** @var string  */
    protected $webUri;

    /** @var string */
    protected $diskUri;

    public function __construct($webUri= '', $diskUri = '', Validator $validator, \PHPExcel $excel)
    {
        $this->excel = $excel;
        $this->validator = $validator;
        $this->webUri = $webUri;
        $this->diskUri = $diskUri;

        $this->validator->rule('required', ['name', 'sheets', 'sheets.*.name', 'sheets.*.data', 'sheets.*.rows', 'sheets.*.cols']);
        $this->validator->rule('array', ['sheets', 'sheets.*.data']);

        $this->validator->rule('min', ['sheets.*.rows', 'sheets.*.cols'], 0);
    }

    /**
     * @param array $post
     * @return Payload
     */
    public function handleRequest(array $post = array())
    {
        $payload = new Payload();

        if (!$this->validator->validate()) {
            $payload->setMessage("Unable to process request, due to errors in the request");
            $payload->setPayload($this->validator->errors());
            return $payload;
        }

        if (!is_writable($this->diskUri)) {
            $payload->setMessage("Path not writable");
            return $payload;
        }

        /**
         * $post['name'] => filename
         * $post['sheets'] => $sheet
         * $sheet['name'] => sheet name
         * $sheet['data'][$n][$m] => value of a cell
         * $sheet['rows'] = $n
         * $sheet['cols] = $m
         */

        foreach ($post['sheets'] as $index => $sheet) {
            $workSheet = null;
            if ($index !=0) {
                $workSheet = $this->excel->addSheet(new \PHPExcel_Worksheet($sheet['name']));
            } else {
                $workSheet = $this->excel->setActiveSheetIndex(0); //First sheet
                $workSheet->setTitle($sheet['name']);
            }
            for ($row = 0; $row < $sheet['rows']; $row++) {
                for ($col = 0; $col < $sheet['cols']; $col++) {
                    $workSheet->setCellValueByColumnAndRow($col, $row, $sheet['data'][$row][$col]);
                }
            }
        }

        $file = $this->diskUri . "/" . $post['name'];

        $writer = new PHPExcel_Writer_Excel2007($this->excel);
        try {
            $writer->save($file);

            $payload->setMessage("Operation successful");
            $payload->setPayload(["file" => $this->webUri . "/" . $post['name']]);
            $payload->setStatus("true");

        } catch (PHPExcel_Writer_Exception $e) {
            $payload->setMessage($e->getMessage());
            $payload->setPayload($e->getTrace());
        }

        return $payload;
    }
}