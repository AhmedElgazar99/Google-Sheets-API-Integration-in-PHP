<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Google\Client;
use Google\Service\Sheets;
use Google\Service\Sheets\ValueRange;
use Google_Client;


class GoogleSheetController extends Controller
{
    //
    public $client,$documentId, $service, $range;
    // public function __construct()
    // {
    //     $this->client = new Client();
    //     $this->service = new Sheets($this->client);
    //     $this->documentId = '1-jCRajsb3LBJWaO2P2Vml-tOmLGFMFAQQr-4MkVtYpA';
    //     $this->range = 'A:Z';
    // }

    public function getClient()
    {
        $client = new Client();
        $client->setApplicationName('Google Sheets Task');
      //  $client->setRedirectUri('http://127.0.0.1:8000/api/readsheet');
        $client->setScopes(Sheets::SPREADSHEETS);
        $client->setAuthConfig(storage_path('app/credentials.json'));
        $client->setAccessType('offline');

        return $client;
    }

    public function readSheet()
    {
        $client = $this->getClient();
        $service = new Sheets($client);
        $spreadsheetId = '1-jCRajsb3LBJWaO2P2Vml-tOmLGFMFAQQr-4MkVtYpA';
        $range = 'A2:Z';
        $doc = $service->spreadsheets_values->get($spreadsheetId, $range);
        return response()->json($doc);
    }


    public function insert(Request $request)
    {
        $client = new Google_Client();
        $client->setApplicationName('Google Sheets API Laravel');
        $client->setScopes(Sheets::SPREADSHEETS);
        $client->setAuthConfig(storage_path('app/credentials.json'));
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

        $service = new Sheets($client);
        $spreadsheetId = '1-jCRajsb3LBJWaO2P2Vml-tOmLGFMFAQQr-4MkVtYpA';
        $range = 'A:Z';
        $values = [
            [$request->input('Student Name'), 
            $request->input('Gender'),
            $request->input('Major'),
            $request->input('Salary'),]
        ];

        $body = new ValueRange([
            'values' => $values
        ]);
        $params = [
            'valueInputOption' => 'RAW'
        ];

        $result = $service->spreadsheets_values->append($spreadsheetId, $range, $body, $params);

        return response()->json(['status' => 'success', 'result' => $result]);
    }


    public function updateSheetByIdname(Request $request, $idname)
    {
        $client = $this->getClient();
        $service = new Sheets($client);
        $spreadsheetId = '1-jCRajsb3LBJWaO2P2Vml-tOmLGFMFAQQr-4MkVtYpA'; 
        $sheetName=$request->input("sheetName");
      //  $sheetName ="Spreadsheet"; // The name of the sheet to update
        $range = $sheetName . '!A:Z'; // Adjust the range as needed to include all relevant columns

        // Get the sheet data
        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
        $values = $response->getValues();

        // Find the row with the matching idname
        $rowIndex = -1;
        foreach ($values as $index => $row) {
            if (isset($row[0]) && $row[0] == $idname) { // Assuming idname is in the first column (A)
                $rowIndex = $index;
                break;
            }
        }

        if ($rowIndex === -1) {
            return response()->json(['status' => 'error', 'message' => 'idname not found'], 404);
        }

        // Update the row with new data
        $values[$rowIndex] = [
            $idname, // Assuming the idname should stay the same
            $request->input('Gender'),// New data for column B
            $request->input('Major'),// New data for column C
            $request->input('Salary'), 
             
        ];

        $body = new ValueRange([
            'values' => [$values[$rowIndex]]
        ]);

        $params = [
            'valueInputOption' => 'RAW'
        ];

        $updateRange = $sheetName . '!A' . ($rowIndex + 1) . ':Z' . ($rowIndex + 1); // Update the specific row range
        $result = $service->spreadsheets_values->update($spreadsheetId, $updateRange, $body, $params);

        return response()->json(['status' => 'success', 'result' => $result]);
    }


    public function getRowByIdname(Request $request, $idname)
    {
        $client = $this->getClient();
        $service = new Sheets($client);
        $spreadsheetId = '1-jCRajsb3LBJWaO2P2Vml-tOmLGFMFAQQr-4MkVtYpA'; // Replace with  actual spreadsheet ID
        $sheetName = "Class Data"; // The name of the sheet to retrieve data from
        $range = $sheetName . '!A:Z'; // Adjust the range as needed to include all relevant columns

        // Get the sheet data
        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
        $values = $response->getValues();

        // Find the row with the matching idname
        $rowIndex = -1;
        $rowData = [];
        foreach ($values as $index => $row) {
            if (isset($row[0]) && $row[0] == $idname) { // Assuming idname is in the first column (A)
                $rowIndex = $index;
                $rowData = $row;
                break;
            }
        }

        if ($rowIndex === -1) {
            return response()->json(['status' => 'error', 'message' => 'idname not found'], 404);
        }

        return response()->json(['status' => 'success', 'data' => $rowData]);
    }
}

