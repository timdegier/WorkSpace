<?php
    session_start();

    $db = new mysqli('localhost','root','','v_o');

    $username = $_SESSION['username'];

    $query1 = "SELECT * FROM users WHERE username=?";
    $prepare1 = $db->prepare($query1);
    $prepare1->bind_param("s",$username);
    $prepare1->execute();

    $result1 = $prepare1->get_result();

    $row1 = $result1->fetch_assoc();

    $company = $row1['company'];

    $query = "SELECT * FROM chat WHERE company=? ORDER BY id DESC LIMIT 12";
    $prepare = $db->prepare($query);
    $prepare->bind_param("s",$company);
    $prepare->execute();

    $result = $prepare->get_result();

    while ($row = $result->fetch_assoc()) {
      echo $row['sendby'] . "[{;:..:;}]" . $row['message'] . "[{;:..:;}]" . $row['date'] . "[{;:..:;}]";
    }
    $prepare->close();
    $prepare1->close();
?>
