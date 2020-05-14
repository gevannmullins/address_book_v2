<div class="container-fluid">
    <div class="row">
        <div class="col-xs-11 text-center">
            <?php
            $ctype = '';
            $cvalue = '';
            $cid = $contact_id;
            $cinfoid = '';
            if ($mode === 'new') {
            ?>
            <h3>Add new Contact Information</h3>
            <?php
            }elseif ($mode === 'edit') {
                $ctype = $contact_info['contact_type'];
                $cvalue = $contact_info['contact_value'];
                $cinfoid = $contact_info['id'];
            ?>
            <h3>Edit Contact Information</h3>
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
            <form action='/api/address_book/add_new_contact_info' method="POST">

                <!-- Contact Type -->
                <div id="contact_type-group" class="form-group">
                    <label for="contact_type_value">Contact Type</label>
                    <select id="contact_type_value" class="form-control" name="contact_type">
                        <option>Select an option</option>
                        <option value="phone">Phone Number</option>
                        <option value="email">Email</option>
                        <option value="address">Address</option>
                    </select>
                    <!-- errors will go here -->
                </div>

                <!-- contact value -->
                <div id="contact_value-group" class="form-group">
                    <label for="contact_value_value">Enter Value</label>
                    <input id="contact_value_value" type="text" class="form-control" name="contact_value" value="<?php echo $cvalue; ?>" placeholder="Phone Number - Email - Address">
                    <!-- errors will go here -->
                </div>

                <input id="id_value" type="hidden" name="contact_id" value="<?php echo $cid; ?>">
                <input id="id_info_value" type="hidden" name="contact_info_id" value="<?php echo $cinfoid; ?>">
                <input id="mode_value" type="hidden" name="mode" value="<?php echo $mode; ?>">

                <button type="submit" class="btn btn-success submit_button">Submit <span class="fa fa-arrow-right"></span></button>

            </form>

        </div>
    </div>
</div>

<script>
    $(".submit_button").on("click", function(e){
        e.preventDefault();
        let contact_id = $("#id_value").val();
        let contact_info_id = $("#id_info_value").val();
        var formData = {
            'contact_type'      : $("#contact_type_value").val(),
            'contact_value'     : $("#contact_value_value").val(),
            'contact_id'        : contact_id,
            'contact_info_id'   : contact_info_id,
            'mode'              : $("#mode_value").val()
        };
        $.ajax({
            type: "POST",
            url: "/api/address_book/add_new_contact_info/"+contact_id,
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