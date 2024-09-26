<?php include 'db_connect.php' ?>
<?php

if(isset($_GET['attendance_id'])){
	// echo "SELECT * FROM attendance_list where id = {$_GET['attendance_id']}";
$qry = $conn->query("SELECT * FROM attendance_list where id = {$_GET['attendance_id']}");
foreach($qry->fetch_array() as $k => $v){
	$$k = $v;
}
}

?>
<!--qr code scanner-->
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header"><b>TRACK ATTENDANCE</b></div>
			<div class="card-body">
		<button type=""value="submit"><h1> <a href="https://docs.google.com/spreadsheets/d/1UJ3TbaS3HIQZJkFlkguwJTx40QXszJuhSnOs3wvEwEs/edit?resourcekey=&gid=1594982017#gid=1594982017">CSC 222</a></h1></button>
	
			</div>
		</div>
	</div>
</div>
 

<style>
	.present-inp,.absent-inp,.late-inp,.present-lbl,.absent-lbl,.late-lbl{
		cursor: pointer;
	}
</style>
<script>
$(document).ready(function(){
	if('<?php echo isset($class_subject_id) ? 1 : 0 ?>' == 1){
		start_load()
		$.ajax({
			url:'ajax.php?action=get_class_list',
			method:'POST',
			data:{class_subject_id:$('#class_subject_id').val(),doc:$('#doc').val(),att_id :'<?php echo isset($id) ? $id : '' ?>' },
			success:function(resp){
				if(resp){
					resp = JSON.parse(resp)
					var _table = $('#table_clone table').clone()
					$('#att-list').html('')
					$('#att-list').append(_table)
					var _type = ['Absent','Present','Late'];
					var data = resp.data;
					var record = resp.record;
					var attendance_id = !!resp.attendance_id ? resp.attendance_id : '';
					if(Object.keys(data).length > 0){
						var i = 1;
						Object.keys(data).map(function(k){
							var name = data[k].name;
							var id = data[k].id;
							var tr = $('<tr></tr>')
							var opts = $('#chk_clone').clone()

							opts.find('.present-inp').attr({'name':'type['+id+']','id':'present_'+id})
							opts.find('.absent-inp').attr({'name':'type['+id+']','id':'absent_'+id})
							opts.find('.late-inp').attr({'name':'type['+id+']','id':'late_'+id})

							opts.find('.present-lbl').attr({'for':'present_'+id})
							opts.find('.absent-lbl').attr({'for':'absent_'+id})
							opts.find('.late-lbl').attr({'for':'late_'+id})

							tr.append('<td class="text-center">'+(i++)+'</td>')
							tr.append('<td class="">'+(name)+'</td>')
							var td = '<td>';
								td += '<input type="hidden" name="student_id['+id+']" value="'+id+'">';
								td += opts.html();
								td += '</td>';
							tr.append(td)

							_table.find('tbody').append(tr)
						})
						$('#submit-btn-field').show()
						$('#edit_att').attr('data-id',attendance_id)
					}else{
							var tr = $('<tr></tr>')
							tr.append('<td class="text-center" colspan="3">No data.</td>')
							_table.find('tbody').append(tr)
						$('#submit-btn-field').attr('data-id','').hide()
						$('#edit_att').attr('data-id','')
					} 
					$('#att-list').html('')
					$('#att-list').append(_table)
					if(Object.keys(record).length > 0){
						Object.keys(record).map(k=>{
							// console.log('[name="type['+record[k].student_id+']"][value="'+record[k].type+'"]')
							$('#att-list').find('[name="type['+record[k].student_id+']"][value="'+record[k].type+'"]').prop('checked',true)
						})
					}
				}
			},
			complete:function(){
				$("input:checkbox").on('keyup keypress change',function(){
				    var group = "input:checkbox[name='"+$(this).attr("name")+"']";
				    $(group).prop("checked",false);
				    $(this).prop("checked",true);
				});
				$('#edit_att').click(function(){
					location.href = 'index.php?page=check_attendance&attendance_id='+$(this).attr('data-id')
				})
				end_load()
			}
		})
	}
	
})
	$('#class_subject_id').change(function(){
		get_data($(this).val())
	})
	window.get_data = function(id){
		start_load()
		$.ajax({
			url:'ajax.php?action=get_class_list',
			method:'POST',
			data:{class_subject_id:id},
			success:function(resp){
				if(resp){
					resp = JSON.parse(resp)
					var _table = $('#table_clone table').clone()
					$('#att-list').html('')
					$('#att-list').append(_table)
					if(Object.keys(resp).length > 0){
						var i = 1;
						Object.keys(resp.data).map(function(k){
							var name = resp.data[k].name;
							var id = resp.data[k].id;
							var tr = $('<tr></tr>')
							var opts = $('#chk_clone').clone()
							opts.find('.present-inp').attr({'name':'type['+id+']','id':'present_'+id})
							opts.find('.absent-inp').attr({'name':'type['+id+']','id':'absent_'+id})
							opts.find('.late-inp').attr({'name':'type['+id+']','id':'late_'+id})

							opts.find('.present-lbl').attr({'for':'present_'+id})
							opts.find('.absent-lbl').attr({'for':'absent_'+id})
							opts.find('.late-lbl').attr({'for':'late_'+id})

							tr.append('<td class="text-center">'+(i++)+'</td>')
							tr.append('<td class="">'+(name)+'</td>')
							var td = '<td>';
								td += '<input type="hidden" name="student_id['+id+']" value="'+id+'">';
								td += opts.html();
								td += '</td>';
							tr.append(td)

							_table.find('tbody').append(tr)
						})
						$('#submit-btn-field').show()
					}else{
							var tr = $('<tr></tr>')
							tr.append('<td class="text-center" colspan="3">No data.</td>')
							_table.find('tbody').append(tr)
						$('#submit-btn-field').hide()
					} 
					$('#att-list').html('')
					$('#att-list').append(_table)
				}
			},
			complete:function(){
				$("input:checkbox").on('keyup keypress change',function(){
					// console.log(test)
				    var group = "input:checkbox[name='"+$(this).attr("name")+"']";
				    $(group).prop("checked",false);
				    $(this).prop("checked",true);
				});
				end_load()
			}
		})
	}
	$('#manage-attendance').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_attendance',
			method:'POST',
			data:$(this).serialize(),
			success:function(resp){
				if(resp==1){
					  alert_toast("Data successfully saved.",'success')
                        setTimeout(function(){
                            location.reload()
                        },1000)
				}else if(resp ==2){
					  alert_toast("Class already has an attendance record with the slected subject and date.",'danger')
					  end_load();
				}
			}
		})
	})
	
</script>