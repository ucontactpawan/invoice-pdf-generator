<?php
require_once __DIR__ . '/MPDF/vendor/autoload.php';

// Get form data
$fullname = $_POST['fullname'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$message = $_POST['message'] ?? '';

// Example invoice data
$invoice = [
    'number' => '9000000001',
    'order' => '9000000001',
    'date' => date('M d, Y, h:i:s A'),
    'customer' => [
        'name' => $fullname,
        'address' => $message,
        'phone' => $phone,
        'email' => $email,
    ],
    'shipping_method' => 'Flat Rate - Fixed',
    'payment_method' => 'COD/ UPI / Bank Transfer',
    'items' => [
        ['name' => 'Fastrack Watch', 'sku' => '24-FW01', 'qty' => 1, 'subtotal' => 49.00],
        ['name' => 'Safari Backpack', 'sku' => '24-SB02', 'qty' => 1, 'subtotal' => 50.00],
        ['name' => 'Milton Water Bottle', 'sku' => '24-MW06', 'qty' => 1, 'subtotal' => 7.00],
        ['name' => 'Lapton Cover - Stylish', 'sku' => '24-LC05', 'qty' => 1, 'subtotal' => 16.00],
        ['name' => 'Remote Contro car', 'sku' => '24-RC05', 'qty' => 1, 'subtotal' => 19.00],
    ],
    'subtotal' => 141.00,
    'discount' => 14.10,
    'tax' => 10.47,
    'shipping' => 25.00,
    'total' => 162.37,
];

$stylesheet = file_get_contents('style.css');

// Build the HTML
$html = '
<html>
<head>
</head>
<body>
<div class="invoice-box">
    <div class="header">
        <div style="left;">
            <img src="download.png" style="width: 100px; height: auto; margin-bottom: 20px;">
        </div>
    </div>
    <table class="summary-table">
        <tr>
            <td><b>INVOICE NUMBER</b><br>#' . $invoice['number'] . '</td>
            <td><b>ORDER</b><br>#' . $invoice['order'] . '</td>
            <td><b>ORDER DATE</b><br>' . $invoice['date'] . '</td>
        </tr>
    </table>
    <hr>
    <table class="summary-table">
        <tr>
            <td>
                <span class="red bold">CUSTOMER NAME</span><br>
                ' . $invoice['customer']['name'] . '<br>
                <span class="red bold">ADDRESS</span><br>
                ' . $invoice['customer']['address'] . '<br>
                <span class="red bold">PHONE</span><br>
                ' . $invoice['customer']['phone'] . '<br>
                <span class="red bold">EMAIL</span><br>
                ' . $invoice['customer']['email'] . '<br>
                <span class="red bold">SHIPPING METHOD</span><br>
                ' . $invoice['shipping_method'] . '<br>
                <span class="red bold">PAYMENT METHOD</span><br>
                ' . $invoice['payment_method'] . '
            </td>
        </tr>
    </table>
    <table class="items-table">
        <tr>
            <th>ITEMS</th>
            <th>QTY</th>
            <th>SUBTOTAL</th>
        </tr>';
foreach ($invoice['items'] as $item) {
    $html .= '
        <tr>
            <td>
                <b>' . $item['name'] . '</b><br>
                <span class="small">SKU: ' . $item['sku'] . '</span>
            </td>
            <td>' . $item['qty'] . '</td>
            <td>&#8377;'. number_format($item['subtotal'], 2) . '</td>
        </tr>';
}
$html .= '
    </table>
    <table class="total-summary">
        <tr>
            <td class="label">SUBTOTAL</td>
            <td class="value">&#8377;' . number_format($invoice['subtotal'], 2) . '</td>
        </tr>
        <tr>
            <td class="label">SHIPPING & HANDLING</td>
            <td class="value">&#8377;' . number_format($invoice['shipping'], 2) . '</td>
        </tr>
        <tr>
            <td class="label">TAX</td>
            <td class="value">&#8377;' . number_format($invoice['tax'], 2) . '</td>
        </tr>
        <tr>
            <td class="label bold">GRAND TOTAL</td>
            <td class="value bold">&#8377;' . number_format($invoice['total'], 2) . '</td>
        </tr>
    </table>
    <div style="margin-top:40px;">
        <b>Thank you for your order!</b><br>
        <span class="small">If you have questions about your order, you can email us at <a href="mailto:support@example.com">support@example.com</a>.</span>
        <br><br>
        <span class="small">
            TrendsShop<br>
            800024 Thane, Mumbai<br>
            India
        </span>
    </div>
</div>
</body>
</html>
';

// Generate PDF
$mpdf = new \Mpdf\Mpdf([
    'margin_left' => 10,
    'margin_right' => 10,
    'margin_top' => 10,
    'margin_bottom' => 10,
]);
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS); // Add CSS
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);        // Add HTML
$mpdf->Output('invoice.pdf', 'I'); // 'I' = display in browser, 'D' = force download
