<?php
// sleep(32);
$conn = new mysqli('localhost', 'root', '', 'phppot_examples',3307);
if (! empty($_POST["keyword"])) {
    $sql = $conn->prepare("SELECT * FROM country WHERE country_name LIKE  ? ORDER BY country_name LIMIT 0,6");
    $search = "{$_POST['keyword']}%";
    $sql->bind_param("s", $search);
    $sql->execute();
    $result = $sql->get_result();
    if (! empty($result)) {
        ?>
<datalist id="country-list">
<?php
        foreach ($result as $country) {
            ?>
   <option
        onClick="selectCountry('<?php echo $country["country_name"]; ?>');">
      <?php echo $country["country_name"]; ?>
        </option>
<?php
        } // end for
        ?>
</datalist>
<?php
    } // end if not empty
}else{?>
    <datalist id="country-list">
    <?php
        $result = $conn->query("SELECT * FROM country");
            foreach ($result as $country) {
                ?>
    <options
            onClick="selectCountry('<?php echo $country["country_name"]; ?>');">
        <?php echo $country["country_name"]; ?>
            </option>
    <?php
            } // end for
            ?>
    </datalist>

<?php
}
?>