<x-admin-layout>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <div class="x flex-col container mx-4 mb-8 border border-0 md:mx-auto">

        <!-- Page Header //-->
        <section class="border-b border-gray-200 py-2 mt-2">
            <div class="text-2xl font-semibold ">
                Dashboard         
            </div>            
        </section>
        <!-- end of Page Header //-->


        <!-- board //-->
        <section class="flex flex-row border border-0 py-1 mt-3">
                <div class="flex flex-col md:flex-row mx-auto md:space-x-2 w-4/5 justify-center items-center">
                    
                    <!-- Document //-->
                    <div class="flex flex-col border border-1 border-yellow-500 
                                w-full md:w-[20%] px-4 py-4 mt-1 rounded-md bg-yellow-500">
                                
                            <div class="flex flex-row">
                                    <div class="flex flex-col flex-1 w-3/4">
                                        <div class="text-white text-3xl">
                                            {{ number_format($documents_count)}}
                                        </div>                            
                                    
                                        <div class="text-sm text-white font-normal">
                                            Documents
                                        </div>
                                    </div>
                                    <div class="w-1/4 flex justify-center items-center border-0">
                                        <i class="fa-regular fa-file text-4xl text-white opacity-50 "></i>
                                    </div>

                            </div>
                    </div>
                    <!-- end of Document //-->


                    <!-- Workflow //-->
                    <div class="flex flex-col border border-1 border-pink-500 
                                w-full md:w-[20%] px-4 py-4 mt-1 rounded-md bg-pink-500">
                                
                            <div class="flex flex-row">
                                    <div class="flex flex-col flex-1 w-3/4">
                                        <div class="text-white text-3xl">
                                            {{ number_format($workflows_count)}}
                                        </div>                            
                                    
                                        <div class="text-sm text-white font-normal">
                                            Workflows
                                        </div>
                                    </div>
                                    <div class="w-1/4 flex justify-center items-center border-0">
                                        
                                        <i class="fa-solid fa-person-digging text-4xl text-white opacity-50 "></i>
                                    </div>

                            </div>
                    </div>
                    <!-- end of Workflow //-->



                    <!-- Staff //-->
                    <div class="flex flex-col border border-1 border-blue-500 
                                        w-full md:w-[20%] px-4 py-4 mt-1 rounded-md bg-blue-500">
                                        
                            <div class="flex flex-row">
                                    <div class="flex flex-col flex-1 w-3/4">
                                        <div class="text-white text-3xl">
                                            {{ number_format($staff_count)}}
                                        </div>                            
                                    
                                        <div class="text-sm text-white font-normal">
                                            Staff
                                        </div>
                                    </div>
                                    <div class="w-1/4 flex justify-center items-center border-0">
                                        
                                        <i class="fa-solid fa-users text-4xl text-white opacity-50 "></i>
                                    </div>

                            </div>
                    </div>
                    <!-- end of Staff //-->


                    <!-- Department //-->
                    <div class="flex flex-col border border-1 border-purple-500 
                                        w-full md:w-[20%] px-4 py-4 mt-1 rounded-md bg-purple-500">
                                        
                            <div class="flex flex-row">
                                    <div class="flex flex-col flex-1 w-3/4">
                                        <div class="text-white text-3xl">
                                            {{ number_format($departments_count)}}
                                        </div>                            
                                    
                                        <div class="text-sm text-white font-normal">
                                            Departments
                                        </div>
                                    </div>
                                    <div class="w-1/4 flex justify-center items-center border-0">
                                        
                                        <i class="fa-regular fa-building text-4xl text-white opacity-50 "></i>
                                    </div>

                            </div>
                    </div>
                    <!-- end of Departments //-->
                    


                    

                    

                    
                </div>
        </section>
        <!-- end of board //-->


        <!-- Document Charts //-->
        <section class="flex flex-col w-full md:flex-row border-0 py-4">
                <!-- Documents by Ministries //-->
                <div class="flex-1 border-0">
                        <div class="hidden">
                            Documents By Ministries
                        </div>
                        <div>
                            <div id="ministry_document_piechart_3d" style="width: 650px; height: 400px;"></div>
                        </div>
                </div>
                <!-- end of Documents by Ministries //-->

                <!-- Documents by Departments //-->
                <div class="flex-1">
                        <div class="hidden">
                            Departments Chart
                        </div>
                        <div>
                            <div id="department_document_piechart_3d" style="width:650px; height:400px"></div>
                        </div>
                </div>
                <!-- end of Documents by Departments //-->
        </section>
        <!-- end of Document Charts //-->
        
        
        <!-- Staff Charts //-->
        <section class="flex flex-col w-full md:flex-row border-0 py-4">
                <!-- Staff by Ministries //-->
                <div class="flex-1 border-0">
                        <div class="hidden">
                            Staff By Ministries
                        </div>
                        <div>
                            <div id="ministry_staff_piechart" style="width: 650px; height: 400px;"></div>
                        </div>
                </div>
                <!-- end of Staff by Ministries //-->

                <!-- Staff by Departments //-->
                <div class="flex-1">
                        <div class="hidden">
                            Staff by Departments
                        </div>
                        <div>
                            <div id="department_staff_dotnut" style="width:650px; height:400px"></div>
                        </div>
                </div>
                <!-- end of Staff by Departments //-->
        </section>
        <!-- end of Staff Charts //-->




            
    </div>
</x-admin-layout>


{{-- 
<script type="text/javascript">
    // Convert PHP array to a JSON object for JavaScript
    var ministriesDocumentsChartData = {!! json_encode($ministries_documents_chart_data) !!};
    var departmentsDocumentsChartData = {!! json_encode($departments_documents_chart_data) !!}
    var ministriesStaffChartData = {!! json_encode($ministries_staff_chart_data) !!}
    var departmentsStaffChartData = {!! json_encode($departments_staff_chart_data) !!}

    // Output the array in the console
    console.log(ministriesDocumentsChartData);
    console.log(departmentsDocumentsChartData);
    console.log(ministriesStaffChartData);
    console.log(departmentsStaffChartData);


</script> 
<script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        
        
        /*
        var dataArray = [];
        Object.entries(ministriesDocumentsChartData).forEach(([ministry, count]) =>{
            dataArray.push([ministry, count]);
        });
        console.log(dataArray);
        */

        //--------   Ministries Documents Chart  //-----------------
        var ministries_documents_data = google.visualization.arrayToDataTable(ministriesDocumentsChartData);

        var optionsMinistryDocument = {
          title: 'Documents by Ministries',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('ministry_document_piechart_3d'));
        chart.draw(ministries_documents_data, optionsMinistryDocument);


        //------------ Departments Documents Chart -------------------
        var departments_documents_data = google.visualization.arrayToDataTable(departmentsDocumentsChartData);

        var optionsDepartmentDocument = {
            title: 'Documents by Departments',
            is3D: true,
        }

        var chart = new google.visualization.PieChart(document.getElementById('department_document_piechart_3d'));
        chart.draw(departments_documents_data, optionsDepartmentDocument);


        //------------- Staff Ministries Chart -------------------------
        var ministries_staff_data = google.visualization.arrayToDataTable(ministriesStaffChartData);

        var optionsMinistryStaff = {
            title: 'Staff by Ministries'
        }

        var chart = new google.visualization.PieChart(document.getElementById('ministry_staff_piechart'));
        chart.draw(ministries_staff_data, optionsMinistryStaff);


        //------------- Staff Departments Chart -------------------------
        var departments_staff_data = google.visualization.arrayToDataTable(departmentsStaffChartData);

        var optionsDepartmentStaff = {
            title: 'Staff by Departments',
            pieHole: 0.4,
        }

        var chart = new google.visualization.PieChart(document.getElementById('department_staff_dotnut'));
        chart.draw(departments_staff_data, optionsDepartmentStaff);
        

      }
</script> --}}