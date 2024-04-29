
<script>
      var lang = $('html').attr('lang');
    //   alert(lang);
    function Sure()
    {
        if(confirm("Are Your Sure To Delete?"))
        {
            return ture;
        }
        else
        {
            return false;
        }

    }
    </script>


    <script>
        $('#submitLoacaleEn').on('click',function(){
            $('#locale').val('en');
            $('#changeLocale').submit();
        });
        $('#submitLoacaleBn').on('click',function(){
            $('#locale').val('bn');
            $('#changeLocale').submit();
        });

        function submitLoacle()
        {

        }
    </script>




<script>
    // Setup - add a text input to each footer cell
    $(".dataTable tfoot th").each(function() {
        var title = $(this).text();
        let lang = $('html').attr('lang');
        let place;
        if(lang == 'en')
        {
            place = 'Search By';
        }
        else
        {
            place = 'সার্চ';
        }
        $(this).html("<input type=\"text\" class=\"form-control\" placeholder=\" "+place+" "+ title + "\" />");
    });
    // DataTables
    var table = $(".dataTable").DataTable({
        select: {
            style: 'multi',
        },
        order: [[0, 'desc']],

    });
    // Apply the search
    table.columns().every(function() {
        var that = this;
        $("input", this.footer()).on("keyup change clear", function() {
            if (that.search() !== this.value) {
                that
                    .search(this.value)
                    .draw();
            }
        });
    });
</script>
<script>
    // Setup - add a text input to each footer cell
    $(".dataTable2 tfoot th").each(function() {
        var title = $(this).text();
        let lang = $('html').attr('lang');
        let place;
        if(lang == 'en')
        {
            place = 'Search By';
        }
        else
        {
            place = 'সার্চ';
        }
        $(this).html("<input type=\"text\" class=\"form-control\" placeholder=\" "+place+" "+ title + "\" />");
    });
    // DataTables
    var table = $(".dataTable2").DataTable({
        select: {
            style: 'multi',
        },
        order: [[0, 'desc']]
    });
    // Apply the search
    table.columns().every(function() {
        var that = this;
        $("input", this.footer()).on("keyup change clear", function() {
            if (that.search() !== this.value) {
                that
                    .search(this.value)
                    .draw();
            }
        });
    });
</script>
<script>
    // Setup - add a text input to each footer cell
    $(".dataTable3 tfoot th").each(function() {
        var title = $(this).text();
        let lang = $('html').attr('lang');
        let place;
        if(lang == 'en')
        {
            place = 'Search By';
        }
        else
        {
            place = 'সার্চ';
        }
        $(this).html("<input type=\"text\" class=\"form-control\" placeholder=\" "+place+" "+ title + "\" />");
    });
    // DataTables
    var table = $(".dataTable3").DataTable({
        select: {
            style: 'multi',
        },
        order: [[0, 'desc']]
    });
    // Apply the search
    table.columns().every(function() {
        var that = this;
        $("input", this.footer()).on("keyup change clear", function() {
            if (that.search() !== this.value) {
                that
                    .search(this.value)
                    .draw();
            }
        });
    });
</script>
<script>
    // Setup - add a text input to each footer cell
    $(".dataTable4 tfoot th").each(function() {
        var title = $(this).text();
        let lang = $('html').attr('lang');
        let place;
        if(lang == 'en')
        {
            place = 'Search By';
        }
        else
        {
            place = 'সার্চ';
        }
        $(this).html("<input type=\"text\" class=\"form-control\" placeholder=\" "+place+" "+ title + "\" />");
    });
    // DataTables
    var table = $(".dataTable4").DataTable({
        select: {
            style: 'multi',
        },
        order: [[0, 'desc']]
    });
    // Apply the search
    table.columns().every(function() {
        var that = this;
        $("input", this.footer()).on("keyup change clear", function() {
            if (that.search() !== this.value) {
                that
                    .search(this.value)
                    .draw();
            }
        });
    });
</script>
<script>
    // Setup - add a text input to each footer cell
    $(".dataTable5 tfoot th").each(function() {
        var title = $(this).text();
        let lang = $('html').attr('lang');
        let place;
        if(lang == 'en')
        {
            place = 'Search By';
        }
        else
        {
            place = 'সার্চ';
        }
        $(this).html("<input type=\"text\" class=\"form-control\" placeholder=\" "+place+" "+ title + "\" />");
    });
    // DataTables
    var table = $(".dataTable5").DataTable({
        select: {
            style: 'multi',
        },
        order: [[0, 'desc']]
    });
    // Apply the search
    table.columns().every(function() {
        var that = this;
        $("input", this.footer()).on("keyup change clear", function() {
            if (that.search() !== this.value) {
                that
                    .search(this.value)
                    .draw();
            }
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Choices.js
        new Choices(document.querySelector(".choices-single"));
        new Choices(document.querySelector(".choices-single2"));
        new Choices(document.querySelector(".choices-single3"));
        new Choices(document.querySelector(".choices-multiple"));
        // Flatpickr
        flatpickr(".flatpickr-minimum");
        flatpickr(".flatpickr-datetime", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
        });
        flatpickr(".flatpickr-human", {
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
        });
        flatpickr(".flatpickr-multiple", {
            mode: "multiple",
            dateFormat: "Y-m-d"
        });
        flatpickr(".flatpickr-range", {
            mode: "range",
            dateFormat: "Y-m-d"
        });
        flatpickr(".flatpickr-time", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var date = new Date(Date.now() - 0 * 24 * 60 * 60 * 1000);
        var defaultDate = date.getUTCFullYear() + "-" + (date.getUTCMonth() + 1) + "-" + date.getUTCDate();
        document.getElementById("datetimepicker-dashboard").flatpickr({
            inline: true,
            prevArrow: "<span class=\"fas fa-chevron-left\" title=\"Previous month\"></span>",
            nextArrow: "<span class=\"fas fa-chevron-right\" title=\"Next month\"></span>",
            defaultDate: defaultDate
        });
    });
</script>
