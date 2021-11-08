<?php
//required files
  require __DIR__.'/../model/admins_main.php';
//Create New Instance Of Admin_Main
    $validate = new admins_main($db);

//Getting Most Recent Users
    $newUsers = $validate->getNewUsers();
    $newReports = $validate->getNewReports();
    $newSubscribers = $validate->getNewSubscribers();
    $newTransactions = $validate->getNewTransactions();
    $newPremiumPay = $validate->getNewPremiumPay();
    $newCards = $validate->getNewCardUsed();
    $newCareerApplicant = $validate->getNewCareerApplicant();
    $newLoanApplicant = $validate->getNewLoanApplicant();
    $newCardUsers = $validate->getNewCardUsers();
    $newOffers = $validate->getNewOffers();

//Chart Analysis
    //Users Analysis
    $allUserProfile = $validate->getAllUserProfile();
    $allUserStatus = $validate->getAllUserStatus();
    $allLoginStatus = $validate->getAllLoginStatus();
    $allGender = $validate->getAllGender();

    //Premium Analysis
    $allSubpay = $validate->getAllSubpay();
    $allTransactions = $validate->getAllTransactions();
    $allTransactionType = $validate->getAllTransactionType();


//Getting Counts For  All Users
    $countUsers = $validate->getCountUsers();
    $countVerified = $validate->getCountVerified();
    $countPremium = $validate->getCountPremium();
    $countDeactivated = $validate->getCountDeactivated();
    $countModerators = $validate->getCountModerators();
    $countAdmins = $validate->getCountAdmins();

//Getting Sum Of Subscribed/Payed Users
    $sumPremium = $validate->getSumPremium();
    $cancelledPremium = $validate->getCancelledPremium();
    $processPremium = $validate->getProcessPremium();

//Getting Sum Of Deposits
    $sumDeposit = $validate->getSumDeposit();
    $cancelledDeposit = $validate->getCancelledDeposit();
    $processDeposit = $validate->getProcessDeposit();

//Getting Sum Of Banking Transactions Withdrawal
    $sumWithdrawal = $validate->getSumWithdrawal();
    $cancelledWithdrawal = $validate->getCancelledWithdrawal();
    $processWithdrawal = $validate->getProcessWithdrawal();

//Getting Sum Of Other Transactions
    $sumMsgreport = $validate->getSumMsgreport();
    $sumSubscribe = $validate->getSumSubscribe();
    $sumCareer = $validate->getSumCareer();
    $sumOffers = $validate->getSumOffers();
    $sumCardinfo = $validate->getSumCardinfo();
    $sumLoanApply = $validate->getSumLoanApply();
    $sumSubpay = $validate->getSumSubpay();
    $sumTransc = $validate->getSumTransc();
    $sumCardUsers = $validate->getSumCardUsers();




//Getting All Users
    $allUsers = $validate->getAllUsers();
    $activatedUsers = $validate->getActivatedUsers();
    $premiumUsers = $validate->getPremiumUsers();
    $deactivatedUsers = $validate->getDeactivatedUsers();

//Getting All Subscribers | Reports
    $allSubscribers = $validate->getAllSubscribers();
    $allReports = $validate->getAllReports();

//Getting All Transactions
    $allCardInfo = $validate->getAllCardInfo();
    $allDeposit = $validate->getAllDeposit();
    $allWithdrawal = $validate->getAllWithdrawal();
    $allMemberPay = $validate->getAllMemberPay();
    $allDeadline = $validate->getAllDeadline();








//Getting New User Alert
    try {
    	$data = $validate->newUserAlert();
    } catch (Exception $e) {
    	$response1a = array(
        "type" => "error",
        "message" => $e->getMessage()
        );
    }

//Getting New Report Alert
    try {
    	$data = $validate->newReportAlert();
    } catch (Exception $e) {
    	$response2a = array(
        "type" => "error",
        "message" => $e->getMessage()
        );
    }

//Getting New Subscriber Alert
    try {
    	$data = $validate->newSubscriberAlert();
    } catch (Exception $e) {
    	$response3a = array(
        "type" => "error",
        "message" => $e->getMessage()
        );
    }

//Getting New Premium Pay Alert
    try {
    	$data = $validate->newPremiumPayAlert();
    } catch (Exception $e) {
    	$response4a = array(
        "type" => "error",
        "message" => $e->getMessage()
        );
    }

//Getting New Transaction Alert
    try {
    	$data = $validate->newTransactionsAlert();
    } catch (Exception $e) {
    	$response5a = array(
        "type" => "error",
        "message" => $e->getMessage()
        );
    }

//Getting New Card Information Alert
    try {
    	$data = $validate->newCardInfoAlert();
    } catch (Exception $e) {
    	$response6a = array(
        "type" => "error",
        "message" => $e->getMessage()
        );
    }

//Getting New Career Alert
    try {
        $data = $validate->newCareerAlert();
    } catch (Exception $e) {
        $response7a = array(
        "type" => "error",
        "message" => $e->getMessage()
        );
    }
//Getting New Loan Alert
    try {
        $data = $validate->newLoanAlert();
    } catch (Exception $e) {
        $response8a = array(
        "type" => "error",
        "message" => $e->getMessage()
        );
    }
//Getting New Card Users Alert
    try {
        $data = $validate->newCardUsersAlert();
    } catch (Exception $e) {
        $response9a = array(
        "type" => "error",
        "message" => $e->getMessage()
        );
    }
//Getting New Offers Applicants Alert
    try {
        $data = $validate->newOffersAlert();
    } catch (Exception $e) {
        $response0a = array(
        "type" => "error",
        "message" => $e->getMessage()
        );
    }






















