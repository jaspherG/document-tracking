@extends('layouts.user_type.auth')

@section('content')

<div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-2">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Report Data</h5>
                        </div>
                        
                        <div class="col-md-4 gap-2 ">
                          <div class="row">
                            <div class="col-md-4">
                              <select required class="form-control filter-service form-select @error('class_year') border-danger @enderror "  type="text" id="class_year" name="class_year">
                                  @if(isset($services) && count($services) > 0)
                                    @foreach($services as $service)
                                      <option value="{{ $service->id }}" >{{ucfirst($service->service_name)}}</option>  
                                    @endforeach
                                  @endif
                              </select>
                            </div>
                            <div class="col-md-5">
                              <select required class="form-control filter-academic-year form-select @error('class_year') border-danger @enderror "  type="text" id="class_year" name="class_year">
                                    <option value="">Filter academic year </option>  
                                    @if(isset($academic_years) && count($academic_years) > 0)
                                      @foreach($academic_years as $academic_year)
                                        <option value="{{ $academic_year }}" >{{$academic_year}}</option>  
                                      @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-2">
                             <button id="service_export" class="btn btn-primary">Export</button>
                            </div>
                          </div>
                        </div>
                          
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0 table-hover ">
                            <thead>
                                <tr>
                                  <th></th>
                                  @if(isset($header_rows) && count($header_rows) > 0)
                                    @foreach($header_rows as $header_row)
                                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        {{$header_row}}
                                      </th>
                                    @endforeach
                                  @endif
                                </tr>
                            </thead>
                            <tbody id="table_body">
                              @if(isset($table_data) && count($table_data) > 0)
                                  @foreach($table_data as $key => $data)
                                      <tr>
                                          <td class="ps-4">
                                              <p class="text-xs font-weight-bold mb-0">{{ $key + 1 }}</p>
                                          </td>
                                          <td class="text-center">
                                              <p class="text-xs font-weight-bold mb-0">{{ $data['student_number'] }}</p>
                                          </td>
                                          <td class="text-center">
                                              <p class="text-xs font-weight-bold mb-0">{{ $data['name'] }}</p>
                                          </td>
                                          @if(isset($data['documents']))
                                              @foreach($data['documents'] as $document)
                                                  <td class="text-center">
                                                      <p class="text-xs font-weight-bold mb-0">{{ $document }}</p>
                                                  </td>
                                              @endforeach
                                          @endif
                                      </tr>
                                  @endforeach
                              @else
                                  <tr>
                                      <td colspan="4">No records found</td>
                                  </tr>
                              @endif
                          </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function(){
      $(document).on('input', '.filter-academic-year', function(){
          var academic_year = $(this).val();
          var service_id = $('.filter-service').val();
            $.get("{{ route('html-functions', ['id' => 'get-filtered-report-data']) }}", {
                service_id: service_id,
                academic_year: academic_year,
            }, function(html) {
                $('#table_body').html(html);
            });
      });
      $(document).on('input', '.filter-service', function(){
          var service_id = $(this).val();
          var academic_year = $('.filter-academic-year').val();
            $.get("{{ route('html-functions', ['id' => 'get-filtered-report-data']) }}", {
                service_id: service_id,
                academic_year: academic_year,
            }, function(html) {
                $('#table_body').html(html);
            });
      });

      $('#service_export').click(function(){
        var service_id = $('.filter-service').val();
        var academic_year = $('.filter-academic-year').val();
        $.get(`{{ route('service.export') }}`, {
            service_id: service_id,
            academic_year: academic_year,
        }, function(data){
            let year = data.year !== 'All' ? `_${data.year}_` : '';
            const titleRow = `${data.title} Requirements A.Y. ${data.year}`;
            let csvContent = `${titleRow}\n\n`; 
            const tableData = data.data;
            csvContent += tableData.map((row) => row.join(',')).join('\n'); 
            const currentDate = new Date().toISOString().slice(0, 10);
            const filename = `${data.title}${year}_report_data_${currentDate}.csv`;

            const blob = new Blob([csvContent], { type: 'text/csv' });
            const url = window.URL.createObjectURL(blob);

            const link = document.createElement('a');
            link.href = url;
            link.setAttribute('download', filename);

            document.body.appendChild(link);
            link.click();

            document.body.removeChild(link);
        });
      });
        
    });
</script>
 
@endsection