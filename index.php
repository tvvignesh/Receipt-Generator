<html>
<form name="receiptform" method="post" action="index.php">
	<fieldset>
		<legend>PAYMENT RECEIPT</legend>
		Customer Name: <input type="text" name="custname">
		<br><br>
		Contact Details:<br>
		<textarea name="contactdet"></textarea>
		<br><br>
		Phone Number: <input type="text" name="phoneno">
		<br><br>
		Type of Project: <input type="text" name="projtype">
		<br><br>
		Project Description:<br>
		<textarea name="projectdesc"></textarea>
		<br><br>
		Project Start Date: <input type="text" name="projsdate">
		<br><br>
		Project End Date: <input type="text" name="projedate">
		<br><br>
		Warranty Period (if any): <input type="text" name="warrantyperiod">
		<br><br>
		Warranty Conditions:<br>
		<textarea name="wconditions"></textarea>
		<br><br>
		Free with this project:<br>
		<textarea name="freeproj"></textarea>
		<br><br>
		Project Completion Proof:<br>
		<textarea name="completeproof"></textarea>
		<br><br>
		Project Amount to be paid (without tax): <input type="text" name="amtpaid">
		<br><br>
		Tax (in perecent): <input type="text" name="taxpercent">
		<br><br>
		Split Details for the amount:<br>
		<textarea name="splitdetails"></textarea>
		<br><br>
		Discount (if any, in percentage): <input type="text" name="discount">
		<br><br>
		Delivery Details (if any): <br>
		<textarea name="delivery"></textarea>
		<br><br>
		Advance amount paid: <input type="text" name="advanceamt">
		<br><br>
		Payment Mode: 
		<select name="paymode">
			<option value="Cash">Cash</option>
			<option value="Cheque">Cheque</option>
			<option value="Credit Card">Credit Card</option>
			<option value="Debit Card">Debit Card</option>
			<option value="Demand Draft">Demand Draft</option>
			<option value="Net Banking">Net Banking</option>
			<option value="Paypal">Paypal</option>
		</select>
		<br><br>
		Currency type: <input type="text" name="curtype">
		<br><br>
		<input type="hidden" name="ispost">
		<div align="center"><input type="submit" value=" GENERATE RECEIPT "></div>
	</fieldset>
</form>

<?php
//final amt,date
if(isset($_POST["ispost"]))
{
require_once 'PHPWord.php';

$PHPWord = new PHPWord();

$document = $PHPWord->loadTemplate('Template.docx');

$custname=$_POST["custname"];
$contactdet=$_POST["contactdet"];
$phoneno=$_POST["phoneno"];
$projtype=$_POST["projtype"];
$projectdesc=$_POST["projectdesc"];
$projsdate=$_POST["projsdate"];
$projedate=$_POST["projedate"];
$warrantyperiod=$_POST["warrantyperiod"];
$wconditions=$_POST["wconditions"];
$freeproj=$_POST["freeproj"];
$completeproof=$_POST["completeproof"];
$amtpaid=$_POST["amtpaid"];
$taxpercent=$_POST["taxpercent"];
$splitdetails=$_POST["splitdetails"];
$discount=$_POST["discount"];
$delivery=$_POST["delivery"];
$advanceamt=$_POST["advanceamt"];
$paymode=$_POST["paymode"];
$curtype=$_POST["curtype"];

$document->setValue('custname', $custname);
$document->setValue('custcontact', $contactdet);
$document->setValue('phoneno', $phoneno);
$document->setValue('projtype', $projtype);
$document->setValue('projdesc', $projectdesc);
$document->setValue('projsdate', $projsdate);
$document->setValue('projedate', $projedate);
$document->setValue('wperiod', $warrantyperiod);
$document->setValue('wconditions', $wconditions);
$document->setValue('projfree', $freeproj);
$document->setValue('completedproof', $completeproof);
$document->setValue('date', date('l'));
$document->setValue('amount', $amtpaid);
$document->setValue('taxpercent', $taxpercent);
$document->setValue('splitdetails', $splitdetails);
$document->setValue('discount', $discount);
$famount=$amtpaid+((($taxpercent)/100)*$amtpaid)-$discount;
$document->setValue('famount', $famount);
$document->setValue('deliver', $delivery);
$document->setValue('advanceamt', $advanceamt);
$document->setValue('advpaymode', $paymode);
$document->setValue('advcurtype', $curtype);


$document->save('testdocs.docx');
}
?>
</html>