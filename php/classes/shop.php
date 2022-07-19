<?php

class Shop {

  public function renderProducts($db){

    $query = 'SELECT * FROM products ORDER BY price';

    $prepare = $db->prepare($query);
    $prepare->execute();

    $result = $prepare->get_result();

    if($result->num_rows > 0){
      while ($row = $result->fetch_assoc()) {
        echo '<div class="col-md-3 p-2 bg-light">
        '.$row['name'].' | €'.$row['price'].'
        <div id="product'.$row['id'].'" class="pt-2"></div>
          <script>
            paypal.Buttons({
              createOrder: function(data, actions) {
                return actions.order.create({
                  purchase_units: [{
                    amount: {
                      value: "'.$row['price'].'"
                    }
                  }]
                });
              },
              onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                  alert("Transaction completed by " + details.payer.name.given_name);
                });
              }
            }).render("#product'.$row['id'].'");
          </script>
        </div>';
      }
    } else {
      echo 'No products found.';
    }

    $prepare->close();

  }

}

?>
