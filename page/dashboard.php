<?php

$sql = "SELECT * FROM devices WHERE active = 'Yes'";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relay Race Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <style>
        /* Custom styling for the dashboard */
        .content-wrapper { padding: 20px; }
        .small-box { background-color: #fff; border-radius: .25rem; box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2); margin-bottom: 20px; padding: 15px; }
        .small-box-icon { font-size: 3rem; width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; text-align: center; }
        .small-box-content { padding-left: 15px; }
        .small-box-text { font-size: 1rem; margin: 0; color: #6c757d; }
        .small-box-number { font-size: 1.8rem; font-weight: 700; margin: 0; color: #343a40; }
        .badge { font-size: 0.9em; padding: 0.4em 0.6em; }
        .bg-info { background-color: #17a2b8 !important; }
        .bg-success { background-color: #28a745 !important; }
        .bg-warning { background-color: #ffc107 !important; }
        .bg-danger { background-color: #dc3545 !important; }
        .bg-primary { background-color: #007bff !important; }
        .bg-secondary { background-color: #6c757d !important; }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <div class="content-wrapper">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <h3>Status</h3>
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3 id="raceStatus">Not Started</h3>
                                <p>Race Status</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-running"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <h3>Total Waktu</h3>
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3><span id="totalRaceTime">0</span> S</h3>
                                <p>Total Race Time</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-flag-checkered"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h3>Durasi Waktu Tongkat di Pegang</h3>
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3><span id="leg1Duration">0</span> S</h3>
                                        <p>Durasi Orang Ke 1</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-person-running"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3><span id="leg2Duration">0</span> S</h3>
                                        <p>Durasi Orang Ke 2</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-person-running"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3><span id="leg3Duration">0</span> S</h3>
                                        <p>Durasi Orang Ke 3</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-person-running"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h3>Waktu Perpindahan Tongkat</h3>
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3><span id="exchange1Duration">0</span> S</h3>
                                        <p>Perpindahan Tongkat 1-2</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-arrows-alt-h"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3><span id="exchange2Duration">0</span> S</h3>
                                        <p>Perpindahan Tongkat 2-3</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-arrows-alt-h"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3><span id="exchange3Duration">0.000</span> S</h3>
                                        <p>Perpindahan Tongkat 3-4</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-arrows-alt-h"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

 <div class="col-12">
        <div class="card card-indigo">
            <div class="card-header">
                <h3 class="card-title">Status Perangkat</h3>
            </div>
            <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th>Serial Number</th>
                            <th>Location</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)){?>
                        <tr>
                            <td><?php echo $row['serial_number'] ?></td>
                            <td><?php echo $row['location'] ?></td>
                            <td style="color:red;" id="estafet/status/<?php echo $row['serial_number']?>">Offline</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
<script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>

<script>
    const clientId = Math.random().toString(16).substr(2, 8);
    const host = 'wss://sistemestafetiot.cloud.shiftr.io:443';

    const options = {
        keepalive: 30,
        clientId: clientId,
        username: "sistemestafetiot",
        password: "123456",
        protocolId: 'MQTT',
        protocolVersion: 4,
        clean: true,
        reconnectPeriod: 1000,
        connectTimeout: 30 * 1000,
    };

    // Function to reset all race statistics to initial state
    function resetRaceStats() {
        document.getElementById("status").innerText = "Not Started";
        document.getElementById("totalRaceTime").innerText = "0.000";
        document.getElementById("leg1Duration").innerText = "0.000";
        document.getElementById("leg2Duration").innerText = "0.000";
        document.getElementById("leg3Duration").innerText = "0.000";
        document.getElementById("exchange1Duration").innerText = "0.000";
        document.getElementById("exchange2Duration").innerText = "0.000";
        document.getElementById("exchange3Duration").innerText = "0.000";
    }


console.log ("Menghubungkan ke Broker");
    const client = mqtt.connect(host, options);

    client.on("connect", ()=>{
        console.log ("Terhubung");
        document.getElementById("status").innerHTML = "Terhubung";
        document.getElementById("status").style.color ='Blue'; 
   
        client.subscribe("estafet/#", {qos: 1});
   
   });

   client.on("message", function(topic, payload) {
    const payloadString = payload.toString();

    // Update race status and total time for the hardcoded device
    if (topic === `estafet/1234567/status_estafet`) {
        const statusElement = document.getElementById("raceStatus");
        statusElement.innerText = payloadString;
        if (payloadString === "Dimulai") {
            statusElement.className = 'info-box-number text-warning';
        } else if (payloadString === "Selesai") {
            statusElement.className = 'info-box-number text-warning';
        } else if (payloadString === "Reset") {
            resetRaceStats();
            statusElement.className = 'info-box-number text-info';
        }
    } 
    // Update individual leg durations for the hardcoded device
    else if (topic === "estafet/1234567/durasi_orang_1") {
        document.getElementById("leg1Duration").innerText = payloadString; // Update leg 1 duration
    } else if (topic === "estafet/1234567/durasi_orang_2") {
        document.getElementById("leg2Duration").innerText = payloadString; // Update leg 2 duration
    } else if (topic === "estafet/1234567/durasi_orang_3") {
        document.getElementById("leg3Duration").innerText = payloadString; // Update leg 3 duration
    }
    // Update baton exchange durations for the hardcoded device
    else if (topic === "estafet/1234567/perpindahan_orang_1_2") {
        document.getElementById("exchange1Duration").innerText = payloadString; // Update exchange 1-2 duration
    } else if (topic === "estafet/1234567/perpindahan_orang_2_3") {
        document.getElementById("exchange2Duration").innerText = payloadString; // Update exchange 2-3 duration
    } else if (topic === "estafet/1234567/perpindahan_orang_3_4") {
        document.getElementById("exchange3Duration").innerText = payloadString; // Update exchange 3-4 duration
    } 
    // Update total race time
    else if (topic === "estafet/1234567/total_waktu_estafet") {
        document.getElementById("totalRaceTime").innerText = payloadString; // Update total race time
    }
    // Update device connection status for any device that publishes status
    else if (topic.startsWith("estafet/status/")) {
        const deviceSerial = topic.split('/').pop(); // Extract serial number from topic
        const statusElement = document.getElementById(`estafet/status/${deviceSerial}`);
        if (statusElement) {
            if (payloadString === "offline") {
                statusElement.innerHTML = '<span class="badge badge-danger">Offline</span>';
            } else if (payloadString === "online") {
                statusElement.innerHTML = '<span class="badge badge-primary">Online</span>';
            }
        }
    }
});

    // client.on("error", function(error) {
    //     console.error("MQTT Error:", error);
    //     document.getElementById("raceStatus").innerText = "Error!";
    // });

    // client.on("close", function() {
    //     console.log("Disconnected from MQTT Broker.");
    //     document.getElementById("raceStatus").innerText = "Disconnected";
    //     const statusElement = document.getElementById(`estafet/status/1234567`);
    //     if (statusElement) {
    //         statusElement.innerHTML = '<span class="badge badge-danger">Offline</span>';
    //     }
    // });

    // client.on("reconnect", function() {
    //     console.log("Attempting to reconnect to MQTT Broker...");
    //     document.getElementById("raceStatus").innerText = "Reconnecting...";
    //     const statusElement = document.getElementById(`estafet/status/1234567`);
    //     if (statusElement) {
    //         statusElement.innerHTML = '<span class="badge badge-warning">Reconnecting...</span>';
    //     }
    // });
</script>
</body>
</html>
