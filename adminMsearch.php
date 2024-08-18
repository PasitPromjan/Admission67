<?php
session_start();
include("config/db.php");

if (isset($_GET['class']) && isset($_GET['stat'])) {
    $class = $_GET['class'];
    $stat = $_GET['stat'];
    $query = isset($_GET['query']) ? $_GET['query'] : '';

    $searchQuery = '%' . $query . '%';

    if ($class == "4") {
        if ($query) {
            $stmt = $conn->prepare("SELECT * FROM m4 WHERE (stat=? and urole='user' and (firstname LIKE ? OR lastname LIKE ?)) ORDER BY id");
            $stmt->execute([$stat, $searchQuery, $searchQuery]);
        } else {
            $stmt = $conn->prepare("SELECT * FROM m4 WHERE stat=? and urole='user' ORDER BY id");
            $stmt->execute([$stat]);
        }
    } else if ($class == "1") {
        if ($query) {
            $stmt = $conn->prepare("SELECT * FROM m1 WHERE (stat=? and urole='user' and (firstname LIKE ? OR lastname LIKE ?)) ORDER BY id");
            $stmt->execute([$stat, $searchQuery, $searchQuery]);
        } else {
            $stmt = $conn->prepare("SELECT * FROM m1 WHERE stat=? and urole='user' ORDER BY id");
            $stmt->execute([$stat]);
        }
    }

    $users = $stmt->fetchAll();

    if (!$users) {
        echo "<tr><td colspan='11' class='text-center'>No data available</td></tr>";
    } else {
        $order = 1;
        foreach ($users as $user) {
            echo "<tr>";
            echo "<td>{$order}</td>";
            echo "<td>{$user['title']}{$user['firstname']} {$user['lastname']}</td>";
            echo "<td>{$user['oldschool']}</td>";
            echo "<td>{$user['pid']}</td>";

            // Fetch Province
            $prov = $conn->query("SELECT * FROM provinces WHERE id={$user['AD_Province']}");
            $province = $prov->fetch(PDO::FETCH_ASSOC);
            echo "<td>{$province['name_th']}</td>";

            // Fetch Amphur
            $prov = $conn->query("SELECT * FROM amphures WHERE id={$user['AD_Subdistrict']}");
            $amphur = $prov->fetch(PDO::FETCH_ASSOC);
            echo "<td>{$amphur['name_th']}</td>";

            if ($stat == 2) {
                echo "<td><button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#userModal' data-bs-whatever='@mdo'>ดูข้อมูล</button></td>";
            }

            echo "<td>{$user['StPN']}</td>";
            echo "<td>{$user['PaPN']}</td>";

            // Fetch edit date
            $editDate = $conn->query("SELECT DAY(edit_when) as day , MONTH(edit_when) as month , YEAR(edit_when) as year, HOUR(edit_when) as hour, MINUTE(edit_when) as minute , SECOND(edit_when) as second FROM ".($class == '4' ? 'm4' : 'm1')." WHERE id={$user['id']}");
            $roww = $editDate->fetch(PDO::FETCH_ASSOC);
            echo "<td>{$roww['day']}/{$roww['month']}/{$roww['year']} {$roww['hour']}:{$roww['minute']}:{$roww['second']}</td>";

            echo "<td>
                    <a href='adminUserData.php?id={$user['id']}&class={$class}' class='btn btn-success'>แก้ไข</a>
                    <a href='adminallow.php?id={$user['id']}&class={$class}' class='btn btn-primary'>ตรวจสอบ</a>";
            if (isset($_SESSION['admin_login'])) {
                echo "<a onclick='return confirm(\"ต้องการจะลบข้อมูลใช่หรือไม่\");' href='?delete={$user['id']}&class={$class}' class='btn btn-danger' style='margin-left: 5px;'>ลบข้อมูล</a>";
            }
            echo "</td>";

            echo "<td>{$user['checkby']}</td>";
            echo "</tr>";

            $order++;  // Increment order here
        }
    }
}
?>
