jQuery(window).on("load", function() {
    jQuery("tbody").sortable({
        delay:150,
        stop:function(){
            var rows = [];
           jQuery("tbody>tr").each(function(){
            var row =[]
                jQuery(this).children().children("input").each(function(){
                    row.push(jQuery(this).val())
                    
                })
                rows.push(row)
           })
           //TODO: Update in DataBase
           rows=rows.filter(n=>n.length)
        }
    })
})


const API = {
    data_to_send : {},
    fetch: function (){
        let data;
        let x = jQuery.ajax({
            url:"https://miusage.com/v1/challenge/1/",
            type:"GET",
            dataType:"JSON",
            data:JSON.stringify({}),
            success:function(e){
                API.createView(e)
            }
        })
        
    },

    createView:function (data){
        let title = data.title
        let headings = data.data.headers //array
        let rows = data.data.rows //objects of users

        API.getTitle(title)
        API.getTableHeaders(headings)
        API.getTableData(rows)
        
    },
    
    getTitle:function (title){
        jQuery("#table_name_heading").append(title)
        jQuery("#table_name").val(title)
    },
    
    getTableHeaders : function (headings){
        headings.forEach((heading)=>{
            jQuery("#data_headings").append(`<th>${heading}</th>`)
        })
    },
    
    getTableData : function (rows){
        Object.keys(rows).forEach((row)=>{
            let newRow = `<tr id='row_id_${rows[row]['id']}'><td><span class="dashicons dashicons-move"></span></td>`
            let removeButton = `<button onclick="API.removeRow(${rows[row]['id']})"><span class="dashicons dashicons-trash"></span></button>`
            Object.keys(rows[row]).forEach((data)=>{
                newRow+="<td><input value='"+rows[row][data]+"'name='"+data+"[]'/></td>"
            })
            newRow += `<td>${removeButton}</td></tr>`
            jQuery("#data_table").append(newRow)
        })
        API.save_data(rows)
    },
    
    removeRow :function (id){
        let row = jQuery(`#row_id_${id}`);
        row.remove();
    },

    save_data :function(data){
        Object.keys(data).forEach(function (key) {
            API.data_to_send[`${key}`] = data[key]
        })
        return API.data_to_send
    }
    
    
}