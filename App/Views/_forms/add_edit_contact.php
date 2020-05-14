<?php

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-xs-11 text-center">
            <?php
            $cname = '';
            $csurname = '';
            $cnickname = '';
            $cid = '';
            if ($mode === 'new') {
            ?>
            <h3>Add new Contact</h3>
            <?php
            }elseif ($mode === 'edit') {
                $cname = $contact_info['name'];
                $csurname = $contact_info['surname'];
                $cnickname = $contact_info['nickname'];
                $cid = $contact_info['id'];
            ?>
            <h3>Edit Contact</h3>
            <?php
            }
            ?>
        </div>
        <div class="col-xs-1 text-center">
            <span class="close_overlay"> X </span>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 text-center">

            <!-- OUR FORM -->
            <form action='/api/address_book/add_new_contact' method="POST">

                <!-- NAME -->
                <div id="name-group" class="form-group">
                    <label for="name">Name</label>
                    <input id="name_value" type="text" class="form-control" name="name" value="<?php echo $cname; ?>" placeholder="Name">
                    <!-- errors will go here -->
                </div>

                <!-- surname -->
                <div id="surname-group" class="form-group">
                    <label for="surname">Surname</label>
                    <input id="surname_value" type="text" class="form-control" name="surname" value="<?php echo $csurname; ?>" placeholder="Surname">
                    <!-- errors will go here -->
                </div>

                <!-- Nick Name -->
                <div id="nickname-group" class="form-group">
                    <label for="nickname">Superhero Alias</label>
                    <input id="nickname_value" type="text" class="form-control" name="nickname" value="<?php echo $cnickname; ?>" placeholder="Ant Man">
                    <!-- errors will go here -->
                </div>

                <input id="id_value" type="hidden" name="contact_id" value="<?php echo $cid; ?>">
                <input id="mode_value" type="hidden" name="mode" value="<?php echo $mode; ?>">

                <button type="submit" class="btn btn-success submit_button">Submit <span class="fa fa-arrow-right"></span></button>

            </form>

        </div>
    </div>
</div>

<script>
    $(".submit_button").on("click", function(e){
        e.preventDefault();
        alert("submitting the form");
        var formData = {
            'name'              : $("#name_value").val(),
            'surname'           : $("#surname_value").val(),
            'nickname'          : $("#nickname_value").val(),
            'mode'              : $("#mode_value").val(),
            'contact_id'        : $("#id_value").val(),
        };
        $.ajax({
            type: "POST",
            url: "/api/address_book/add_new_contact",
            dataType: "JSON",
            data: formData,
            success: function(result){
                $(".overlay_content").html("<h1>Data submitted successfully...</h1>");
                $(".overlay_container").fadeOut();
                $(".overlay_content").html("");
                $(".overlay_content").empty();
                window.location.href = '/v2';

            }
        });

    });


    $(".close_overlay").click(function(){
        $(".overlay_content").html("");
        $(".overlay_content").empty();
        $(".overlay_container").fadeOut();
    });
</script>