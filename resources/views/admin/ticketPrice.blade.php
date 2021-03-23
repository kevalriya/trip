
           <?php
$number_of_locations = count($RoutePoint); 
$CityPost=array();
            if($number_of_locations > 0)
          {
    ?>
    <h4>Adult Ticket Fare </h4>
    <div class="col-md-2 col-sm-2 col-xs-2">
      <table cellpadding="0" cellspacing="0" border="0" class="table">
        <thead>
          <tr class="title-head-row">
            <th>&nbsp;</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach($RoutePoint as $k => $v)
          {
            if($k <= ($number_of_locations - 2))
            {
              ?>
              <tr class="title-row" lang="<?php echo $v['CITY_CODE']; ?>">
                <td><?php echo $v['CITY_NAME'] ?></td>
              </tr>
              <?php
            }
          } 
          ?>
        </tbody>
      </table>
    </div>
    <div class="col-md-10 col-sm-10 col-xs-10">
      
      
        
          <table cellpadding="0" cellspacing="0" border="0" class="table" id="compare_table" >
              <thead>
              <tr class="content-head-row">
                <?php
                $j = 1;
                foreach($RoutePoint as $v)
                {
                  if($j > 1)
                  {
                    ?>
                    <th class="<?php echo $j == 2 ? 'first-col' : null;?>" >
                      <?php echo $v['CITY_NAME'] ?>
                    </th>
                    <?php
                  }
                  $j++;
                } 
                ?>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($RoutePoint as $k => $row)
              {
                if($k <= ($number_of_locations - 2))
                {
                  ?>
                  <tr class="content_row_<?php echo $row['CITY_CODE']; ?>">
                    <?php
                    $j = 1;
                    foreach($RoutePoint as $col)
                    {
                      if($j > 1)
                      {
                        $pair_id = $row['CITY_CODE'] . '_' . $col['CITY_CODE'];
                        
                        ?>
                        <td class="<?php echo $j == 2 ? 'first-col' : null;?>" >
                          <?php
                          if($col['ROUTE_STOPPOINT_SEQNO'] > $row['ROUTE_STOPPOINT_SEQNO'])
                          { 
                            ?>
                              <span class="pj-form-field-custom pj-form-field-custom-before">
                                <span class="pj-form-field-before"><abbr class="pj-form-field-icon-text">
                                  
                                </abbr></span>
                                <input type="text" name="adult[<?php echo $row['CITY_CODE'] ?>_<?php echo $col['CITY_CODE'] ?>]"  class="form-control" value="" />
                              </span>
                            <?php
                          }else{
                            echo '&nbsp;';
                          } 
                          ?>
                        </td>
                        <?php
                      }
                      $j++;
                    } 
                    ?>
                  </tr>
                  <?php
                }
              } 
              ?>
            </tbody>
          </table>
       
      </div>
  <hr>

    <h4>Child Ticket Fare </h4>
    <div class="col-md-2 col-sm-2 col-xs-2">
      <table cellpadding="0" cellspacing="0" border="0" class="table">
        <thead>
          <tr class="title-head-row">
            <th>&nbsp;</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach($RoutePoint as $k => $v)
          {
            if($k <= ($number_of_locations - 2))
            {
              ?>
              <tr class="title-row" lang="<?php echo $v['CITY_CODE']; ?>">
                <td><?php echo $v['CITY_NAME'] ?></td>
              </tr>
              <?php
            }
          } 
          ?>
        </tbody>
      </table>
    </div>
    <div class="col-md-10 col-sm-10 col-xs-10">
      
      
        
          <table cellpadding="0" cellspacing="0" border="0" class="table" id="compare_table" >
              <thead>
              <tr class="content-head-row">
                <?php
                $j = 1;
                foreach($RoutePoint as $v)
                {
                  if($j > 1)
                  {
                    ?>
                    <th class="<?php echo $j == 2 ? 'first-col' : null;?>" >
                      <?php echo $v['CITY_NAME'] ?>
                    </th>
                    <?php
                  }
                  $j++;
                } 
                ?>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($RoutePoint as $k => $row)
              {
                if($k <= ($number_of_locations - 2))
                {
                  ?>
                  <tr class="content_row_<?php echo $row['CITY_CODE']; ?>">
                    <?php
                    $j = 1;
                    foreach($RoutePoint as $col)
                    {
                      if($j > 1)
                      {
                        $pair_id = $row['CITY_CODE'] . '_' . $col['CITY_CODE'];
                        ?>
                        <td class="<?php echo $j == 2 ? 'first-col' : null;?>" >
                          <?php
                          if($col['ROUTE_STOPPOINT_SEQNO'] > $row['ROUTE_STOPPOINT_SEQNO'])
                          { 
                            ?>
                              <span class="pj-form-field-custom pj-form-field-custom-before">
                                <span class="pj-form-field-before"><abbr class="pj-form-field-icon-text">
                                  
                                </abbr></span>
                                <input type="text" name="child[<?php echo $row['CITY_CODE'] ?>_<?php echo $col['CITY_CODE'] ?>]" class="form-control" value="" />
                              </span>
                            <?php
                          }else{
                            echo '&nbsp;';
                          } 
                          ?>
                        </td>
                        <?php
                      }
                      $j++;
                    } 
                    ?>
                  </tr>
                  <?php
                }
              } 
              ?>
            </tbody>
          </table>
        
      </div>
  <hr> 

    <h4>Special Ticket Fare </h4>
    <div class="col-md-2 col-sm-2 col-xs-2">
      <table cellpadding="0" cellspacing="0" border="0" class="table">
        <thead>
          <tr class="title-head-row">
            <th>&nbsp;</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach($RoutePoint as $k => $v)
          {
            if($k <= ($number_of_locations - 2))
            {
              ?>
              <tr class="title-row" lang="<?php echo $v['CITY_CODE']; ?>">
                <td><?php echo $v['CITY_NAME'] ?></td>
              </tr>
              <?php
            }
          } 
          ?>
        </tbody>
      </table>
    </div>
    <div class="col-md-10 col-sm-10 col-xs-10">
      
      
        
          <table cellpadding="0" cellspacing="0" border="0" class="table" id="compare_table" >
              <thead>
              <tr class="content-head-row">
                <?php
                $j = 1;
                foreach($RoutePoint as $v)
                {
                  if($j > 1)
                  {
                    ?>
                    <th class="<?php echo $j == 2 ? 'first-col' : null;?>" >
                      <?php echo $v['CITY_NAME'] ?>
                    </th>
                    <?php
                  }
                  $j++;
                } 
                ?>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($RoutePoint as $k => $row)
              {
                if($k <= ($number_of_locations - 2))
                {
                  ?>
                  <tr class="content_row_<?php echo $row['CITY_CODE']; ?>">
                    <?php
                    $j = 1;
                    foreach($RoutePoint as $col)
                    {
                      if($j > 1)
                      {
                        $pair_id = $row['CITY_CODE'] . '_' . $col['CITY_CODE'];
                        ?>
                        <td class="<?php echo $j == 2 ? 'first-col' : null;?>" >
                          <?php
                          if($col['ROUTE_STOPPOINT_SEQNO'] > $row['ROUTE_STOPPOINT_SEQNO'])
                          { 
                            ?>
                              <span class="pj-form-field-custom pj-form-field-custom-before">
                                <span class="pj-form-field-before"><abbr class="pj-form-field-icon-text">
                                  
                                </abbr></span>
                                <input type="text"  name="special[<?php echo $row['CITY_CODE'] ?>_<?php echo $col['CITY_CODE'] ?>]" class="form-control" value="" />
                              </span>
                            <?php
                          }else{
                            echo '&nbsp;';
                          } 
                          ?>
                        </td>
                        <?php
                      }
                      $j++;
                    } 
                    ?>
                  </tr>
                  <?php
                }
              } 
              ?>
            </tbody>
          </table>
        
      </div>
  <hr>

    <?php
  } 
  else{
    echo "<h3>No Stop Point Found </h3>";
  }
  ?>
          	
    