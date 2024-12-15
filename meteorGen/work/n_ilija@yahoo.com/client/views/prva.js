/**
 * Meteor: the smart way to build applications!
 *
 * @copyright     Copyright 2014, 
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 *
 * filename:      client/views/prva.js
 * generated:     2024/12/12 9:37
 */

Template.prva.helpers({
    prva: function() {
        return prva.find().fetch();
    },
    modalTitle: function() {
        switch(Session.get("activity")){
            case 'add':
                return i18n('prva.modalTitleAdd');
            case 'view':
                return i18n('prva.modalTitleView');
            case 'edit':
                return i18n('prva.modalTitleEdit');
            case 'delete':
                return i18n('prva.modalTitleDelete');
        }
    },
    modalBody: function() {
        var tHeader = '<table style="width: 100%;"><tbody>';
        var tdLeft1 = '<tr><td style="width: 20%; text-align: right; padding-top: 5px;"><label>';
        var tdLeft2 = '</label></td><td style="width: 2%;"></td>';
        var tdRight1 = '<td style="width: 78%;"><input type="txt,mail,number,password,date,checkbox,radio" style="height: 23px; width: 100%;" class="form-control" id="';
        var tdRight2Add = '" /></td></tr>';
        var tdRight2View = '" value="';
        var tdRight2ViewEnd = '" disabled=""/></td></tr>';
        var tFooter ='</tbody></table>';
        switch(Session.get("activity")){
            case 'add':
                return Spacebars.SafeString(tHeader
                +tdLeft1+i18n('prva.fieldprvopoljeModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="txt" style="height: 23px; width: 100%;" class="form-control" id="'+'m_prvopolje'+tdRight2Add
                +tdLeft1+i18n('prva.fielddrugopoljeModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="mail" style="height: 23px; width: 100%;" class="form-control" id="'+'m_drugopolje'+tdRight2Add
                +tdLeft1+i18n('prva.fieldtreceModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="number" style="height: 23px; width: 100%;" class="form-control" id="'+'m_trece'+tdRight2Add
                +tdLeft1+i18n('prva.fieldcetvroModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="password" style="height: 23px; width: 100%;" class="form-control" id="'+'m_cetvro'+tdRight2Add
                +tdLeft1+i18n('prva.fieldpetoModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="date" style="height: 23px; width: 100%;" class="form-control" id="'+'m_peto'+tdRight2Add
                +tdLeft1+i18n('prva.fieldsetoModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="checkbox" style="height: 23px; width: 100%;" class="form-control" id="'+'m_seto'+tdRight2Add
                +tdLeft1+i18n('prva.fieldsedmoModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="radio" style="height: 23px; width: 100%;" class="form-control" id="'+'m_sedmo'+tdRight2Add
                +tFooter);
            case 'view':
                return Spacebars.SafeString(tHeader
                +tdLeft1+i18n('prva.fieldIdModalLabel')+tdLeft2+tdRight1+'m_id'+tdRight2View+Session.get('_id')+tdRight2ViewEnd
                +tdLeft1+i18n('prva.fieldprvopoljeModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="txt" style="height: 23px; width: 100%;" class="form-control" id="'+'m_prvopolje'+tdRight2View+Session.get('prvopolje')+tdRight2ViewEnd
                +tdLeft1+i18n('prva.fielddrugopoljeModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="mail" style="height: 23px; width: 100%;" class="form-control" id="'+'m_drugopolje'+tdRight2View+Session.get('drugopolje')+tdRight2ViewEnd
                +tdLeft1+i18n('prva.fieldtreceModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="number" style="height: 23px; width: 100%;" class="form-control" id="'+'m_trece'+tdRight2View+Session.get('trece')+tdRight2ViewEnd
                +tdLeft1+i18n('prva.fieldcetvroModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="password" style="height: 23px; width: 100%;" class="form-control" id="'+'m_cetvro'+tdRight2View+Session.get('cetvro')+tdRight2ViewEnd
                +tdLeft1+i18n('prva.fieldpetoModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="date" style="height: 23px; width: 100%;" class="form-control" id="'+'m_peto'+tdRight2View+Session.get('peto')+tdRight2ViewEnd
                +tdLeft1+i18n('prva.fieldsetoModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="checkbox" style="height: 23px; width: 100%;" class="form-control" id="'+'m_seto'+tdRight2View+Session.get('seto')+tdRight2ViewEnd
                +tdLeft1+i18n('prva.fieldsedmoModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="radio" style="height: 23px; width: 100%;" class="form-control" id="'+'m_sedmo'+tdRight2View+Session.get('sedmo')+tdRight2ViewEnd
                +tFooter);
            case 'edit':
                return Spacebars.SafeString(tHeader
                +tdLeft1+i18n('prva.fieldIdModalLabel')+tdLeft2+tdRight1+'m_id'+tdRight2View+Session.get('_id')+tdRight2ViewEnd
                +tdLeft1+i18n('prva.fieldprvopoljeModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="txt" style="height: 23px; width: 100%;" class="form-control" id="'+'m_prvopolje'+tdRight2View+Session.get('prvopolje')+tdRight2Add
                +tdLeft1+i18n('prva.fielddrugopoljeModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="mail" style="height: 23px; width: 100%;" class="form-control" id="'+'m_drugopolje'+tdRight2View+Session.get('drugopolje')+tdRight2Add
                +tdLeft1+i18n('prva.fieldtreceModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="number" style="height: 23px; width: 100%;" class="form-control" id="'+'m_trece'+tdRight2View+Session.get('trece')+tdRight2Add
                +tdLeft1+i18n('prva.fieldcetvroModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="password" style="height: 23px; width: 100%;" class="form-control" id="'+'m_cetvro'+tdRight2View+Session.get('cetvro')+tdRight2Add
                +tdLeft1+i18n('prva.fieldpetoModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="date" style="height: 23px; width: 100%;" class="form-control" id="'+'m_peto'+tdRight2View+Session.get('peto')+tdRight2Add
                +tdLeft1+i18n('prva.fieldsetoModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="checkbox" style="height: 23px; width: 100%;" class="form-control" id="'+'m_seto'+tdRight2View+Session.get('seto')+tdRight2Add
                +tdLeft1+i18n('prva.fieldsedmoModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="radio" style="height: 23px; width: 100%;" class="form-control" id="'+'m_sedmo'+tdRight2View+Session.get('sedmo')+tdRight2Add
                +tFooter);
            case 'delete':
                return Spacebars.SafeString(tHeader
                +tdLeft1+i18n('prva.fieldIdModalLabel')+tdLeft2+tdRight1+'m_id'+tdRight2View+Session.get('_id')+tdRight2ViewEnd
                +tdLeft1+i18n('prva.fieldprvopoljeModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="txt" style="height: 23px; width: 100%;" class="form-control" id="'+'m_prvopolje'+tdRight2View+Session.get('prvopolje')+tdRight2ViewEnd
                +tdLeft1+i18n('prva.fielddrugopoljeModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="mail" style="height: 23px; width: 100%;" class="form-control" id="'+'m_drugopolje'+tdRight2View+Session.get('drugopolje')+tdRight2ViewEnd
                +tdLeft1+i18n('prva.fieldtreceModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="number" style="height: 23px; width: 100%;" class="form-control" id="'+'m_trece'+tdRight2View+Session.get('trece')+tdRight2ViewEnd
                +tdLeft1+i18n('prva.fieldcetvroModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="password" style="height: 23px; width: 100%;" class="form-control" id="'+'m_cetvro'+tdRight2View+Session.get('cetvro')+tdRight2ViewEnd
                +tdLeft1+i18n('prva.fieldpetoModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="date" style="height: 23px; width: 100%;" class="form-control" id="'+'m_peto'+tdRight2View+Session.get('peto')+tdRight2ViewEnd
                +tdLeft1+i18n('prva.fieldsetoModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="checkbox" style="height: 23px; width: 100%;" class="form-control" id="'+'m_seto'+tdRight2View+Session.get('seto')+tdRight2ViewEnd
                +tdLeft1+i18n('prva.fieldsedmoModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="radio" style="height: 23px; width: 100%;" class="form-control" id="'+'m_sedmo'+tdRight2View+Session.get('sedmo')+tdRight2ViewEnd
                +tFooter);
        }
    },
    modalFooter: function() {
        switch(Session.get("activity")){
            case 'add':
                return new Spacebars.SafeString('<button type="button" class="btn btn-default btn-xs" data-dismiss="modal">'+i18n('prva.modalFooterCancel')+'</button>'
                + '<button id="bAdd" type="button" class="btn btn-success btn-xs">'+i18n('prva.modalFooterAdd')+'</button>');
            case 'view':
                return new Spacebars.SafeString('<button type="button" class="btn btn-default btn-xs" data-dismiss="modal">'+i18n('prva.modalFooterClose')+'</button>');
            case 'edit':
                return new Spacebars.SafeString('<button type="button" class="btn btn-default btn-xs" data-dismiss="modal">'+i18n('prva.modalFooterCancel')+'</button>'
                       + '<button id="bEdit" type="button" class="btn btn-primary btn-xs">'+i18n('prva.modalFooterChange')+'</button>');
            case 'delete':
                return new Spacebars.SafeString('<button type="button" class="btn btn-default btn-xs" data-dismiss="modal">'+i18n('prva.modalFooterNo')+'</button>'
                       + '<button id="bDelete" type="button" class="btn btn-danger btn-xs">'+i18n('prva.modalFooterYes')+'</button>');
        }
    },
    settings: function() {
        return {
            fields: [
                { key: 'bittons', label: '',
                    fn: function (value, object) {
                        return new Spacebars.SafeString('<a data-toggle="modal" data-tooltip="'+i18n('prva.tooltipView')+'" data-target="#modalPrva" onclick="Session.set('+"'activity','view'"+');" class="label label-default tooltip-right"><i class="glyphicon glyphicon-search"></i></a>'
                                +'<a data-toggle="modal" data-tooltip="'+i18n('prva.tooltipEdit')+'" data-target="#modalPrva" onclick="Session.set('+"'activity','edit'"+');" class="label label-primary tooltip-right"><i class="glyphicon glyphicon-edit"></i></a>'
                                +'<a data-toggle="modal" data-tooltip="'+i18n('prva.tooltipDelete')+'" data-target="#modalPrva" onclick="Session.set('+"'activity','delete'"+');" class="label label-danger tooltip-right"><i class="glyphicon glyphicon-remove"></i></a>'
                        );
                    }
                },
                { key: 'prvopolje', label: i18n('prva.fieldprvopoljeGridLabel'), sort: 'asc' },
                { key: 'drugopolje', label: i18n('prva.fielddrugopoljeGridLabel'), sort: 'asc' },
                { key: 'trece', label: i18n('prva.fieldtreceGridLabel'), sort: 'asc' },
                { key: 'cetvro', label: i18n('prva.fieldcetvroGridLabel'), sort: 'asc' },
                { key: 'peto', label: i18n('prva.fieldpetoGridLabel'), sort: 'asc' },
                { key: 'seto', label: i18n('prva.fieldsetoGridLabel'), sort: 'asc' },
                { key: 'sedmo', label: i18n('prva.fieldsedmoGridLabel'), sort: 'asc' }
            ],
            rowClass: function(item) {},
            showFilter: true,
            rowsPerPage:10,
            showNavigation:'auto', //  always never auto
            useFontAwesome: true,
            showNavigationRowsPerPage: true,
            showColumnToggles:false,
            class: "table table-striped table-hover" // table table-striped table-bordered table-hover table-condensed
        }
    }
});

Template.prva.events({
    'click .reactive-table tr': function (event) {
        if(this._id!=undefined) {
            Session.set('_id', this._id);
            Session.set('prvopolje', this.prvopolje);
            Session.set('drugopolje', this.drugopolje);
            Session.set('trece', this.trece);
            Session.set('cetvro', this.cetvro);
            Session.set('peto', this.peto);
            Session.set('seto', this.seto);
            Session.set('sedmo', this.sedmo);
        }
    },
    'click #bAdd': function(event) {
        var err = validateInput_Prva();
        if(err == 0){
            try {
                prva.insert({
                       'prvopolje': $('#m_prvopolje').val(),
                       'drugopolje': $('#m_drugopolje').val(),
                       'trece': $('#m_trece').val(),
                       'cetvro': $('#m_cetvro').val(),
                       'peto': $('#m_peto').val(),
                       'seto': $('#m_seto').val(),
                       'sedmo': $('#m_sedmo').val()
            });
                $.growl('<strong>'+i18n('prva.growlSuccessAdd')+'</strong>', {
                    type: 'success', z_index: 99999, allow_dismiss: false
                });
            }
            catch(err) {
                $.growl('<strong>'+i18n('prva.growlError')+'</strong><br />'+err.message, {
                    type: 'danger', z_index: 99999, allow_dismiss: false
                });
            }
            $('#modalPrva').modal('hide');
        }
    },
    'click #bEdit': function(event) {
        var err = validateInput_Prva();
        if(err == 0){
            try {
                prva.update({'_id': Session.get('_id')}, {$set: {
                       'prvopolje': $('#m_prvopolje').val(),
                       'drugopolje': $('#m_drugopolje').val(),
                       'trece': $('#m_trece').val(),
                       'cetvro': $('#m_cetvro').val(),
                       'peto': $('#m_peto').val(),
                       'seto': $('#m_seto').val(),
                       'sedmo': $('#m_sedmo').val()
			}});
                $.growl('<strong>'+i18n('prva.growlSuccessEdit')+'</strong>', {
                    type: 'success', z_index: 99999, allow_dismiss: false
                });
            }
            catch(err) {
                $.growl('<strong>'+i18n('prva.growlError')+'</strong><br />'+err.message, {
                    type: 'danger', z_index: 99999, allow_dismiss: false
                });
            }
            $('#modalPrva').modal('hide');
        }
    },
    'click #bDelete': function(event) {
        try {
            prva.remove({ '_id': Session.get('_id')});
            $.growl('<strong>'+i18n('prva.growlSuccessDelete')+'</strong>', {
                type: 'success', z_index: 99999, allow_dismiss: false
            });
        }
        catch(err) {
            $.growl('<strong>'+i18n('prva.growlError')+'</strong><br />'+err.message, {
                type: 'danger', z_index: 99999, allow_dismiss: false
            });
        }
        $('#modalPrva').modal('hide');
    }
});

Template.prva.rendered = function() {
    $('.reactive-table-filter').html('<div class="row">'
            +'<h3 class="pull-left" style="color: rgb(49, 112, 143);"><em><strong>'+i18n('prva.title')+'</strong></em></h3>'
            +'<h3 class="pull-right"><a data-tooltip="'+i18n('prva.tooltipPrint')+'" class="btn btn-info btn-sm tooltip-left">'+i18n('prva.titlePrint')+'</a>&nbsp;&nbsp;'
            +'<a data-toggle="modal" data-tooltip="'+i18n('prva.tooltipAdd')+'" data-target="#modalPrva" onclick="Session.set(' + "'activity','add'" + ');"class="btn btn-success btn-sm tooltip-left">+</a></h3>'
            +'</div>'
            +$('.reactive-table-filter').html()
    );
    $('#modalPrva').on('shown.bs.modal', function (e) {
        if(Session.get('activity')=='add') {
            $('#m_prvopolje').val('');
            $('#m_drugopolje').val('');
            $('#m_trece').val('');
            $('#m_cetvro').val('');
            $('#m_peto').val('');
            $('#m_seto').val('');
            $('#m_sedmo').val('');
        } else {
            $('#m_prvopolje').val(Session.get('prvopolje'));
            $('#m_drugopolje').val(Session.get('drugopolje'));
            $('#m_trece').val(Session.get('trece'));
            $('#m_cetvro').val(Session.get('cetvro'));
            $('#m_peto').val(Session.get('peto'));
            $('#m_seto').val(Session.get('seto'));
            $('#m_sedmo').val(Session.get('sedmo'));
        }
        $('#m_prvopolje').focus();
    });
}

function validateInput_Prva() {
    var err = 0;
    if($('#m_prvopolje').val().length < 2) {
        $.growl('<strong>'+i18n('prva.growlError')+'</strong><br />'+i18n('prva.fieldprvopoljeGrowlErrorMessage'), {
            type: 'danger', z_index: 99999, allow_dismiss: false
        });
        err++;
    }
    if($('#m_drugopolje').val().length < 2) {
        $.growl('<strong>'+i18n('prva.growlError')+'</strong><br />'+i18n('prva.fielddrugopoljeGrowlErrorMessage'), {
            type: 'danger', z_index: 99999, allow_dismiss: false
        });
        err++;
    }
    if($('#m_trece').val().length < 2) {
        $.growl('<strong>'+i18n('prva.growlError')+'</strong><br />'+i18n('prva.fieldtreceGrowlErrorMessage'), {
            type: 'danger', z_index: 99999, allow_dismiss: false
        });
        err++;
    }
    if($('#m_cetvro').val().length < 2) {
        $.growl('<strong>'+i18n('prva.growlError')+'</strong><br />'+i18n('prva.fieldcetvroGrowlErrorMessage'), {
            type: 'danger', z_index: 99999, allow_dismiss: false
        });
        err++;
    }
    if($('#m_peto').val().length < 2) {
        $.growl('<strong>'+i18n('prva.growlError')+'</strong><br />'+i18n('prva.fieldpetoGrowlErrorMessage'), {
            type: 'danger', z_index: 99999, allow_dismiss: false
        });
        err++;
    }
    if($('#m_seto').val().length < 2) {
        $.growl('<strong>'+i18n('prva.growlError')+'</strong><br />'+i18n('prva.fieldsetoGrowlErrorMessage'), {
            type: 'danger', z_index: 99999, allow_dismiss: false
        });
        err++;
    }
    if($('#m_sedmo').val().length < 2) {
        $.growl('<strong>'+i18n('prva.growlError')+'</strong><br />'+i18n('prva.fieldsedmoGrowlErrorMessage'), {
            type: 'danger', z_index: 99999, allow_dismiss: false
        });
        err++;
    }
    return err;
}
// End of generated file