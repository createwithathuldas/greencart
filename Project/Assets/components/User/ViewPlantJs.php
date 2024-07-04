<script src="../Assets//JS//Ajax//jQuery.js"></script>
<script>
    function viewPlant(searchName) {
        $.ajax({
            url: '../Assets/AjaxPages/AjaxSearchPlant.php?searchName=' + searchName,
            success: function (data) {
                $('#viewplant').html(data);
            }
        })
    }
</script>