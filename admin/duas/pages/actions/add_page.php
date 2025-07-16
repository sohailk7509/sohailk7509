<?php
require_once '../../includes/session.php';
require_once '../../config/db.php';
checkLogin();

// Set JSON header
header('Content-Type: application/json');

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $page_id = $_POST['page_id'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $status = $_POST['status'];

        // For donations page, handle bank details
        if ($page_id == 'donations') {
            $banks = [];
            
            // Get bank details from form
            if (isset($_POST['bank_name']) && is_array($_POST['bank_name'])) {
                for ($i = 0; $i < count($_POST['bank_name']); $i++) {
                    $banks[] = [
                        'name' => $_POST['bank_name'][$i],
                        'title' => $_POST['account_title'][$i],
                        'account_no' => $_POST['account_no'][$i],
                        'iban' => $_POST['iban'][$i],
                        'branch' => $_POST['branch_name'][$i],
                        'branch_code' => $_POST['branch_code'][$i],
                        'swift' => $_POST['swift_code'][$i]
                    ];
                }
            }
            
            // Convert banks array to JSON and append to content
            if (!empty($banks)) {
                $banksHtml = '<div class="row custom-row"><section class="name-results contact-table">';
                foreach ($banks as $bank) {
                    $banksHtml .= sprintf('
                        <div class="row mb-5">
                            <div class="col-md-12 text-center">
                                <div class="bank-name">%s</div>
                            </div>
                            <div class="col-md-12">
                                <table>
                                    <tbody>
                                        <tr><td style="width:40%%">Title</td><td><b>%s</b></td></tr>
                                        <tr><td style="width:40%%">Account No</td><td><b>%s</b></td></tr>
                                        <tr><td style="width:40%%">IBAN</td><td><b>%s</b></td></tr>
                                        <tr><td style="width:40%%">Branch Name</td><td><b>%s</b></td></tr>
                                        <tr><td style="width:40%%">Branch Code</td><td><b>%s</b></td></tr>
                                        <tr><td style="width:40%%">Swift Code</td><td><b>%s</b></td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>',
                        $bank['name'],
                        $bank['title'],
                        $bank['account_no'],
                        $bank['iban'],
                        $bank['branch'],
                        $bank['branch_code'],
                        $bank['swift']
                    );
                }
                $banksHtml .= '</section></div>';
                $content .= $banksHtml;
            }
        }

        // Insert into database
        $stmt = $db->prepare("INSERT INTO pages (page_id, title, content, status, created_at) VALUES (?, ?, ?, ?, NOW())");
        $result = $stmt->execute([$page_id, $title, $content, $status]);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to save page']);
        }
    } else {
        echo json_encode([
            'success' => false,
            'error' => 'Invalid request method'
        ]);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
} 