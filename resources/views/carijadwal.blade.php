Carijadwal
<?php
if (isset($_POST["query"])) {

    $poli_input = $_POST["query"];

    date_default_timezone_set('Asia/Jakarta');

    $consid = "123456";
    $secretKey = "0034T2";

    $tStamp = strval(time() - strtotime('1970-01-01 00:00:00'));

    $signature = hash_hmac('sha256', $tStamp . $consid, $secretKey, true);
    $encodedSignature = base64_encode($signature);

    $headers = array(
        "X-Cons-ID: " . $consid,
        "X-Timestamp: " . $tStamp,
        "X-Signature: " . $encodedSignature,
        "Content-Type: Application/JSON"
    );

    $ch = curl_init();

    curl_setopt(
        $ch,
        CURLOPT_URL,
        "https://latu.rs-elisabeth.com/medinfrasapi/rsses/api/physician/list/doctor-schedule/" . $poli_input
    );

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    // LOG API
    $logFile = __DIR__ . "/api_log.txt";

    $logMessage =
        "[" . date("Y-m-d H:i:s") . "] Poli: " . $poli_input .
        "\n" . $response . "\n\n";

    file_put_contents($logFile, $logMessage, FILE_APPEND);

    $array_response = json_decode($response, true);

    if (
        isset($array_response['Status']) &&
        $array_response['Status'] === 'SUCCESS'
    ) {

        $data = $array_response['Data'];

        if (count($data) < 1) {

            echo '
                <div class="alert alert-warning mb-0">
                    Jadwal dokter belum tersedia.
                </div>
            ';

            exit;
        }

        $output1 = '<div class="row g-3">';

        foreach ($data as $jadwal) {

            $foto =
                "https://mobile.rs-elisabeth.com/paramedic/" .
                $jadwal['ParamedicCode'] . ".png";

            $output1 .= '
                <div class="col-12">
                    <div class="card border-0 h-100">

                        <div class="card-body">

                            <div class="row g-3">

                                <div class="col-md-3 text-center">

                                    <img
                                        src="' . $foto . '"
                                        class="img-fluid rounded"
                                        style="max-height:180px; object-fit:cover;"
                                        onerror="this.onerror=null;this.src=`https://dummyimage.com/300x300/e9ecef/6c757d&text=No Photo`;"
                                    >

                                </div>

                                <div class="col-md-9">

                                    <div class="d-flex justify-content-between align-items-start flex-wrap">

                                        <div>
                                            <h5 class="fw-bold mb-1">
                                                ' . $jadwal['ParamedicName'] . '
                                            </h5>

                                            <div class="text-muted mb-3">
                                                ' . $jadwal['ServiceUnitName'] . '
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row g-3">
            ';

            foreach ($jadwal['Schedules'] as $datahari) {

                $jam = str_replace('|', '<br>', $datahari['OperationalTimeName']);

                $output1 .= '
                    <div class="col-md-4 col-sm-6">

                        <div class="border rounded p-3 h-100 bg-light">

                            <div class="fw-bold text-primary mb-2">
                                ' . $datahari['Day'] . '
                            </div>

                            <div style="font-size:14px;">
                                ' . $jam . '
                            </div>

                        </div>

                    </div>
                ';
            }

            $output1 .= '
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            ';
        }

        $output1 .= '</div>';

        echo $output1;

    } else {

        echo '
            <div class="alert alert-danger mb-0">
                Gagal mengambil data jadwal dokter.
            </div>
        ';
    }

    curl_close($ch);
}
?>