<?php
// Restore original sales statement table view
$conversionRate = 15000;

function formatCurrency($amount) {
    return 'Rp ' . number_format($amount, 0, ',', '.');
}

// Logic to fetch and display sales statement data here
// Example usage of currency formatting
foreach ($sales as $sale) {
    echo formatCurrency($sale['amount']);
}
?>