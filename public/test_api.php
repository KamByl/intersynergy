<?php
function CallAPI($method, $url, $data = false, $port = 80)
{
    $curl = curl_init();

    switch ($method) {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    // Optional Authentication:
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json'));
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_PORT, $port);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}

$data = json_decode(CallAPI('GET', 'http://192.168.43.101/api/osobies', false, 8000));

if (isset($_GET['id'])) {
    $data = json_decode(CallAPI('GET', 'http://192.168.43.101/api/osobies/' . $_GET['id'], false, 8000));
    foreach ($data as $key => $value) {
        echo "<b>" . $key . "</b> - " . $value . "<br />";
    }
} else {
    $data = json_decode(CallAPI('GET', 'http://192.168.43.101/api/osobies', false, 8000));
    foreach ($data as $osoba) {
        echo '<a href="?id=' . $osoba->id . '">' . $osoba->nazwisko . ' ' . $osoba->imie . '</a><br />';
    }
}
