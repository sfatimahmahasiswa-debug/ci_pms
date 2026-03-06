<?php
// Assuming this is the PHP file that displays sales statement

// Sample data for demonstration (you would typically loop and get this from a database)
$sales_data = [
    ['item' => 'Product A', 'price' => 100],
    ['item' => 'Product B', 'price' => 200],
];

// Function to convert USD to IDR
function convertToIDR($amount) {
    return 'Rp ' . number_format($amount * 15000, 0, ',', '.');
}

$total_penjualan = 0;

foreach ($sales_data as $sale) {
    $amount_idr = convertToIDR($sale['price']);
    echo '<p>' . $sale['item'] . ': ' . $amount_idr . '</p>';
    $total_penjualan += $sale['price'];
}

// Update Total Penjualan calculation
$total_penjualan_idr = convertToIDR($total_penjualan);

echo '<h3>Total Penjualan: ' . $total_penjualan_idr . '</h3>';
?>