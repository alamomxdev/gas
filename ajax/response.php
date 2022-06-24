<?php
	//Conexion a la base de datos de Fleetmaster
	$server = 'fleetmasterusabackup.database.windows.net';
	$database = 'FM_ALAMO';
	$username = 'ALAMOBI';
	$password = 'mS51DW1dhJM9uUsLgv8z';

	$serverName = $server;
	$databaseName = $database;
	$uid = $username;
	$pwd = $password;

	$fm_l = new PDO("sqlsrv:server = $serverName; Database = $databaseName;", $uid, $pwd);

	$today      = date('Y-m-d');
    $yesterday  = date('Y-m-d', strtotime('-15 days'));

	$sql="select vh.SequenceNumber as VehicleNumber, vh.ChassisNumber,
        vh.VehicleTypeId, vh_types.Name as SIPP, vh.ModelId, vh_models.Name as Model, 
        vh.Active, vh.ActiveInFleet,
        vh.ExternalId,
        vh.FuelCapacity,
        JSON_VALUE( vh.ExtraProperties, '$.licensePlate' ) as licensePlate,
        JSON_VALUE( vh.ExtraProperties, '$.modelYear' ) as modelYear,
        JSON_VALUE( vh.ExtraProperties, '$.vehicleVersion' ) as vehicleVersion,
        vdh.VehicleDriverHistoryNumber, vdh.SequenceNumber, vdh.ExternalId as PlanningId, vdh.StartOdometer, vdh.EndOdometer, 
        vdh.DropOffLocationId, pick_l.Name as PickUpLocation, pick_r.Id as PickUpRegionId, pick_r.Name as PickUpRegion, pick_sr.Id as PickUpRegionSrId, pick_sr.Name as PickUpRegionSr,
        vdh.PickUpLocationId, drop_l.Name  as DropOffLocation, drop_r.Id as DropUpRegionId,  drop_r.Name as DropUpRegion, drop_sr.Id as DropUpRegionSrId, drop_sr.Name as DropUpRegionSr,
        vdh.InvoicingStatus,
        case 
            when vdh.InvoicingStatus=0 then 'Planned'
            when vdh.InvoicingStatus=1 then 'Current'
            when vdh.InvoicingStatus=2 then 'Ended'
            when vdh.InvoicingStatus=3 then 'InvoiceProposal'
            when vdh.InvoicingStatus=4 then 'Invoice'
            when vdh.InvoicingStatus=5 then 'Closed'
            when vdh.InvoicingStatus=6 then 'Canceled'
            when vdh.InvoicingStatus=7 then 'Deleted'
            when vdh.InvoicingStatus=8 then 'ToPlan'
            when vdh.InvoicingStatus=9 then 'Overdue'
        else '404'
        end as SquenceStatus,
        Case when vdhtt.Id = 26 then 'Reservaciones' else 'Planeacion' end as TipoEstatus, 
        vdht.Name as Type,
        CAST(SWITCHOFFSET(vdh.StartTime, SUBSTRING(CAST(CAST(vdh.StartTime AS DATETIME) AT TIME ZONE isnull(pick_l.timezone, t.tenanttimezone) AS VARCHAR), 25, 6)) AS DATETIME) as StartTime, 
        CAST(SWITCHOFFSET(vdh.ActualStartTime, SUBSTRING(CAST(CAST(vdh.ActualStartTime AS DATETIME) AT TIME ZONE isnull(pick_l.timezone, t.tenanttimezone) AS VARCHAR), 25, 6)) AS DATETIME) as ActualStartTime,
        CAST(SWITCHOFFSET(vdh.EndTime, SUBSTRING(CAST(CAST(vdh.EndTime AS DATETIME) AT TIME ZONE isnull(drop_l.timezone, t.tenanttimezone) AS VARCHAR), 25, 6)) AS DATETIME) as EndTime, 
        CAST(SWITCHOFFSET(vdh.ActualEndTime, SUBSTRING(CAST(CAST(vdh.ActualEndTime AS DATETIME) AT TIME ZONE isnull(drop_l.timezone, t.tenanttimezone) AS VARCHAR), 25, 6)) AS DATETIME) as ActualEndTime
        from Vehicles as vh
        left join Models as vh_models on vh_models.Id=vh.ModelId
        left join VehicleTypes as vh_types on vh_types.Id=vh.VehicleTypeId
        left join VehicleDriverHistories as vdh on vdh.VehicleId=vh.Id and vdh.Active=1
        left join Tenants t on t.Id = vdh.TenantId and t.ShortName = 'Alamo'
        --Obtener las oficina, plaza y region de salida
        left join Locations as pick_l on pick_l.Id=vdh.PickUpLocationId
        left join Regions as pick_r on pick_r.Id=pick_l.RegionId
        left join Regions as pick_sr on pick_sr.Id=pick_r.ParentId
        --Obtener las oficina, plaza y region de retorno
        left join Locations  as drop_l on drop_l.Id=vdh.DropOffLocationId
        left join Regions as drop_r on drop_r.Id=drop_l.RegionId
        left join Regions as drop_sr on drop_sr.Id=drop_r.ParentId
        --Obtener el tipo de planeacion
        left join VehicleDriverHistoryTemplates vdht on vdht.Id = vdh.TemplateId
        left join VehicleDriverHistoryTemplateTypes vdhtt on vdhtt.Id = vdht.TypeId
        where vh.SequenceNumber = $_GET[e]
       	and CAST(SWITCHOFFSET(vdh.StartTime, SUBSTRING(CAST(CAST(vdh.StartTime AS DATETIME) AT TIME ZONE isnull(pick_l.timezone, t.tenanttimezone) AS VARCHAR), 25, 6)) AS DATETIME) between '$yesterday' and '$today'
        order by ActualEndTime desc";
	$res = $fm_l->query( $sql );

	while ($row = $res->fetch()) {
		foreach ($row as $key => $value) {
        	if( gettype($key)=="integer" )
        		unset( $row[$key] );
        }

        $response[] = $row;
	}

	$result['result'] = $response;

	echo json_encode($result);
?>