{% extends "layouts/base_v2.html" %}

{% block title %}Home - Address Book{% endblock %}

{% block body %}
<script type="text/javascript">
    $(document).ready(function() {
        $("#menu").accordion();
    });
</script>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <a class="new_contact ajax_loader" id="add_new_contact" href="/address_book/add_new_view">
                Add New
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col=md-12">


            <?php print_r($contacts); ?>

            <style>
                .menu-header-dom {
                    background-color: #000000 !important;
                }
            </style>


                <div class="content">

                    <nav>

                        <div id="menu" class="menu">
                            <div class="menu-header menu-header-dom" style=""> Contacts </div>

                            <!-- menu links -->
                            <ul>
                                <li class="active">
                                    <a href="#" class="load_admin_content">
                                        <i class="fa fa-home"></i>Link 1
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-file-image-o"> </i>Link2
                                    </a>
                                    <!-- sub-menu -->
                                    <ul class="submenu">
                                        <li><a href="#" class="load_admin_content">Sub-Link1</a></li>
                                        <li>
                                            <a href="#">Sub-Link2</a>
                                            <ul class="submenu">
                                                <li><a href="#" class="load_admin_content">Sub-Sub-Link1</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>


                            </ul>
                        </div>

                    </nav>
                </div>



        </div>
    </div>
</div>

{% endblock %}


{% block scripts %}
<script>
    $(document).ready(function(){

        $(".load_admin_content").on('click', function(e){
            e.preventDefault();
            let thisUrl = $(this).attr("href");
            $('.admin_content_container').load(thisUrl);

        });

    });
</script>
<script>

</script>
{% endblock %}