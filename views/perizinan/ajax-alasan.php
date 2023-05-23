<option value="">.:Pilih alasan:.</option>
<?php
if ($alasan) {
	foreach ($alasan as $a) {
		?>
		<option value="<?= $a->name ?>"><?= $a->name ?></option>
<?php
	}
}
?>
<option value="other">Alasan lain</option>
