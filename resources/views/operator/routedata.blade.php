 <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Create Route</h4>
              </div>
              <form method="post" id="route_update_frm">
                 {{ csrf_field() }}
                 <input type="hidden" name="routeId" value="{{$Route->ROUTE_ID}}">
              <div class="modal-body">
                      <div id="uresponse" class="alert alert-success" style="display:none;">
      <a href="#" class="close" data-dismiss="alert">&times;</a>
      <div class="message"></div>
    </div>
                
                        <div class="form-group col-md-6">
                            <label>Route Name</label>

                         <input type="text" class="form-control required" name="routeName" value="{{$Route->ROUTE_NAME}}" >

                        </div>

       

                 <div class="clearfix"> </div>


       <div class="form-group col-md-6">
                  <label for="name">Origin State</label>
                   <select class="form-control state" data-cls="uocity" id="uostate" name="ostate"  data-placeholder="Select State" aria-hidden="true">
                      <option value="">Select State</option>
              

                   @foreach ($States as $State)
                    <option value="{{ $State->STATE_CODE }}" @if ($State->STATE_CODE == $OCity[0]->STATE_CODE)
                        selected
                      @endif>{{ $State->NAME }}</option>
                    @endforeach
                  </select>
                </div>

                  <div class="form-group col-md-6">
                   <label> Origin City </label>
                   <select class="form-control uocity required" id="uorcity" name="orcity"  data-placeholder="Select a City" aria-hidden="true">
                    <option value="">Select City</option>
                    @foreach ($OCity as $City)
                    <option value="{{ $City->CITY_CODE }}"
                       @if ($City->CITY_CODE == $Route->ORIGIN_CITY)
                        selected
                      @endif
                      >{{ $City->CITY_NAME }}</option>
                    @endforeach
                  </select>
                </div>
<div class="clearfix"></div>

                       <div class="form-group col-md-6">
                  <label for="name">Destination State</label>
                   <select class="form-control state" data-cls="udcity"  id="udstate" data-placeholder="Select State" aria-hidden="true">
                      <option value="">Select State</option>
              

                   @foreach ($States as $State)
                    <option value="{{ $State->STATE_CODE }}" @if ($State->STATE_CODE == $DCity[0]->STATE_CODE)
                        selected
                      @endif>{{ $State->NAME }}</option>
                    @endforeach
                  </select>
                </div>

                  <div class="form-group col-md-6">
                  <label>Destination City</label>
                   <select class="form-control udcity required" id="udescity" name="descity"  data-placeholder="Select a City" aria-hidden="true">
                    <option value="">Select City</option>
                    @foreach ($DCity as $City)
                    <option value="{{ $City->CITY_CODE }}"
                       @if ($City->CITY_CODE == $Route->DEST_CITY)
                        selected
                      @endif
                      >{{ $City->CITY_NAME }}</option>
                    @endforeach
                  </select>
                </div>

                  <div class="clearfix"> </div>
      
              </div>
              <div class="clearfix"> </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
                </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div> 

      