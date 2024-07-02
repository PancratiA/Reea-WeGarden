<?php
session_start();

if (!isset($_SESSION['basket'])) { //daca nu exista basket-ul acesta este creeat
    $_SESSION['basket'] = [];
}

function calculateTotal() { //calcul total pret
    $total = 0;
    foreach ($_SESSION['basket'] as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    return $total;
}

function addToBasket($serviceId, $name, $price) {
    
    foreach ($_SESSION['basket'] as &$item) { //daca exista, creste cantitatea
        if ($item['id'] == $serviceId) {
            $item['quantity']++;
            return; 
        }
    }

    
    $_SESSION['basket'][] = [ //atfel creeaza nou
        'id' => $serviceId,
        'name' => $name,
        'price' => $price,
        'quantity' => 1 
    ];
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'add') {
        } elseif ($_POST['action'] === 'remove' && isset($_POST['index'])) { //remove din basket
            $index = $_POST['index'];
            removeFromBasket($index);
        } elseif ($_POST['action'] === 'update' && isset($_POST['index']) && isset($_POST['quantity_update'])) { // + - quantity
            $index = $_POST['index'];
            $quantity_update = $_POST['quantity_update'];
            
            if ($quantity_update === '+') {
                $_SESSION['basket'][$index]['quantity']++;
            } elseif ($quantity_update === '-') {
                if ($_SESSION['basket'][$index]['quantity'] > 1) {
                    $_SESSION['basket'][$index]['quantity']--;
                } else {
                    removeFromBasket($index); // Remove daca e  - si cantitate 1
                }
            }
        }
    }
}


function removeFromBasket($index) {
    if (isset($_SESSION['basket'][$index])) {
        unset($_SESSION['basket'][$index]);
        $_SESSION['basket'] = array_values($_SESSION['basket']); 
    }
}


?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="mystyle.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="sticky"> <i>WeGarden</i>  <br>
    <a class="contact" href="index.php#contact">Contact : +40 746 099 123   </a>
</div>

<ul class="sticky">
     <li class="sticky"><a href="index.php">Home</a></li>
     <li class="sticky"><a href="index.php#about">About us</a></li>
     <li class="sticky"><a href="services.php">Services</a></li>
     <?php


if (isset($_SESSION['user_id'])) {
    $session_active = true;
} else {
    $session_active = false;
}
?>
<?php if ($session_active): ?>
         <li class="basket "><a href="logout.php"><i>Log Out</i></a></li>
     <?php endif; ?>

     <li class="basket active"><a href="basket.php"><i  class="fa">&#xf291;</i></a></li>
     

</ul>

<div class="basket-container">
    <?php if (empty($_SESSION['basket'])): ?>
        <p>Your basket is empty.</p>
    <?php else: ?>
        <table>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th></th>
            </tr>
            <?php foreach ($_SESSION['basket'] as $index => $item): ?>
    <tr>
        <td><?php echo $item['name']; ?></td>
        <td>$<?php echo $item['price']; ?></td>
        <td>
            <form method="post" class="quantity-form">
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="index" value="<?php echo $index; ?>">
                <button type="submit" name="quantity_update" value="-">-</button>
                <?php echo $item['quantity']; ?>
                <button type="submit" name="quantity_update" value="+">+</button>
            </form>
        </td>
        <td>
            <form method="post">
                <input type="hidden" name="action" value="remove">
                <input type="hidden" name="index" value="<?php echo $index; ?>">
                <button type="submit">Remove</button>
            </form>
        </td>
    </tr>
<?php endforeach; ?>

            <tr>
                <td colspan="4" style="text-align: right;">
                    <strong>Total:</strong> $<?php echo calculateTotal(); ?>
                </td>
            </tr>
        </table>
    <?php endif; ?>
</div>

</body>
</html>
