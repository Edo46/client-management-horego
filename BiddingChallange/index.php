<?php

$items = array(
    array(
        'name'            => 'item-a',            # Nama Item
        'price'           => 70000,               # Harga Maximum
        'quantity'        => 1000,                # Jumlah item yang akan dikerjakan
        'production_time' => 8,                   # Lama pengerjaan dalam hari
        'start'           => '2017-11-14 10:00',  # Mulai bidding
        'end'             => '2017-11-14 12:00'   # Akhir bidding
    ),

    array(
        'name'            => 'item-b',
        'price'           => 50000,
        'quantity'        => 2000,
        'production_time' => 10,
        'start'           => '2017-11-14 12:00',
        'end'             => '2017-11-14 15:00'
    )
);

# Submissions
#
# Berikut adalah data harga yang ditawarkan oleh masing-masing peserta bidding untuk setiap item di atas.
# Urutan tanggal submit sengaja diacak.
# Harga yang diambil dari setiap user adalah harga yang terakhir di tawarkan.

$submissions = array(
    array(
        'name' => 'Wili',                   # Nama Partner
        'bidding' => array(
            'item-a' => array(                # Submissions untuk item-a
                '2017-11-14 10:00' => array(    # Tanggal submit
                    'price'           => 65000,   # Harga yang ditawarkan
                    'production_time' => 9        # Lama pengerjaan dalam hari
                ),
                '2017-11-14 12:00' => array(
                    'price'           => 68000,
                    'production_time' => 9
                ),
                '2017-11-14 10:30' => array(
                    'price'           => 71000,
                    'production_time' => 9
                ),
                '2017-11-14 12:30' => array(
                    'price'           => 10000,
                    'production_time' => 9
                )
            ),

            'item-b' => array(
                '2017-11-14 14:30' => array(
                    'price'           => 40000,
                    'production_time' => 9
                ),
                '2017-11-14 12:30' => array(
                    'price'           => 50000,
                    'production_time' => 9
                )
            )
        )
    ),

    array(
        'name' => 'Lita',
        'bidding' => array(
            'item-b' => array(
                '2017-11-14 13:30' => array(
                    'price'           => 45000,
                    'production_time' => 9
                ),
                '2017-11-14 15:01' => array(
                    'price'           => 35000,
                    'production_time' => 9
                ),
                '2017-11-14 12:30' => array(
                    'price'           => 48000,
                    'production_time' => 9
                )
            )
        )
    ),

    array(
        'name' => 'Sabar',
        'bidding' => array(
            'item-a' => array(
                '2017-11-14 11:50' => array(
                    'price'           => 65000,
                    'production_time' => 9
                ),
                '2017-11-14 11:30' => array(
                    'price'           => 68000,
                    'production_time' => 9
                ),
                '2017-11-14 11:00' => array(
                    'price'           => 69000,
                    'production_time' => 9
                )
            )
        )
    ),

    array(
        'name' => 'Makmur',
        'bidding' => array(
            'item-a' => array(
                '2017-11-14 12:00' => array(
                    'price'           => 50000,
                    'production_time' => 9
                ),
                '2017-11-14 11:00' => array(
                    'price'           => 5000,
                    'production_time' => 9
                )
            )
        )
    )
);

function cmp($a, $b)
{
    return strcmp($a['bidd']['price'], $b['bidd']['price']);
}

foreach ($items as $item) {
    foreach ($submissions as $submission) {
        foreach ($submission['bidding'] as $k => $l) {
            if ($k == $item['name']) {
                $start = ($item['start']);
                $end = ($item['end']);

                $key = array_keys($l);
                foreach ($key as $kk) {
                    $kkk = ($kk);
                    if ($k == $item['name']) {
                        if ($kk >= $start && $kk <= $end) {
                            $time[] = $kkk;
                        }
                    }
                }

                $ke = max(($time));
                $bid_time = $l[$ke];
                $bid_time['time'] = $ke;
                $res[$k][] = [
                    'bid' => $k,
                    'name'  => $submission['name'],
                    'bidd' => $bid_time,
                ];
            }
            $time = [];
        }
    }
}

foreach ($items as $item) {
    echo "# " . $item['name'] . ' - ' . $item['quantity'] . ' - ' . $item['price'] . '<br>';
    echo "Peserta (" . count($res[$item['name']]) . "):<br>";
    echo '<table style="width:100%">';

    $rowNumber = 1;

    foreach ($res as $kr => $ress) {
        if ($kr == $item['name']) {
            usort($ress, "cmp");
            foreach ($ress as $rs) {
                echo '<tr>';
                echo '<td>' . $rowNumber++ . '</td>';
                echo '<td>' . $rs['name'] . '</td>';
                echo '<td>' . $rs['bidd']['time'] . '</td>';
                echo '<td>' . $rs['bidd']['price'] . '</td>';
                echo '<td>' . ($rs['bidd']['price'] * $item['quantity']) . '</td>';
                echo '</tr>';
            }
        }
    }
    echo '</table>';
}