/**
 * Meteor: the smart way to build applications!
 *
 * @copyright     Copyright 2014, 
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 *
 * filename:      client/views/druga.js
 * generated:     2024/12/12 9:37
 */

Template.druga.helpers({
    druga: function() {
        return druga.find().fetch();
    },
    modalTitle: function() {
        switch(Session.get("activity")){
            case 'add':
                return i18n('druga.modalTitleAdd');
            case 'view':
                return i18n('druga.modalTitleView');
            case 'edit':
                return i18n('druga.modalTitleEdit');
            case 'delete':
                return i18n('druga.modalTitleDelete');
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
                +tdLeft1+i18n('druga.fieldprvopoljeModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="txt" style="height: 23px; width: 100%;" class="form-control" id="'+'m_prvopolje'+tdRight2Add
                +tdLeft1+i18n('druga.fielddrugopoljeModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="mail" style="height: 23px; width: 100%;" class="form-control" id="'+'m_drugopolje'+tdRight2Add
                +tdLeft1+i18n('druga.fieldtreceModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="number" style="height: 23px; width: 100%;" class="form-control" id="'+'m_trece'+tdRight2Add
                +tdLeft1+i18n('druga.fieldcetvroModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="password" style="height: 23px; width: 100%;" class="form-control" id="'+'m_cetvro'+tdRight2Add
                +tdLeft1+i18n('druga.fieldpetoModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="date" style="height: 23px; width: 100%;" class="form-control" id="'+'m_peto'+tdRight2Add
                +tdLeft1+i18n('druga.fieldsetoModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="checkbox" style="height: 23px; width: 100%;" class="form-control" id="'+'m_seto'+tdRight2Add
                +tdLeft1+i18n('druga.fieldsedmoModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="radio" style="height: 23px; width: 100%;" class="form-control" id="'+'m_sedmo'+tdRight2Add
                +tFooter);
            case 'view':
                return Spacebars.SafeString(tHeader
                +tdLeft1+i18n('druga.fieldIdModalLabel')+tdLeft2+tdRight1+'m_id'+tdRight2View+Session.get('_id')+tdRight2ViewEnd
                +tdLeft1+i18n('druga.fieldprvopoljeModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="txt" style="height: 23px; width: 100%;" class="form-control" id="'+'m_prvopolje'+tdRight2View+Session.get('prvopolje')+tdRight2ViewEnd
                +tdLeft1+i18n('druga.fielddrugopoljeModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="mail" style="height: 23px; width: 100%;" class="form-control" id="'+'m_drugopolje'+tdRight2View+Session.get('drugopolje')+tdRight2ViewEnd
                +tdLeft1+i18n('druga.fieldtreceModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="number" style="height: 23px; width: 100%;" class="form-control" id="'+'m_trece'+tdRight2View+Session.get('trece')+tdRight2ViewEnd
                +tdLeft1+i18n('druga.fieldcetvroModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="password" style="height: 23px; width: 100%;" class="form-control" id="'+'m_cetvro'+tdRight2View+Session.get('cetvro')+tdRight2ViewEnd
                +tdLeft1+i18n('druga.fieldpetoModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="date" style="height: 23px; width: 100%;" class="form-control" id="'+'m_peto'+tdRight2View+Session.get('peto')+tdRight2ViewEnd
                +tdLeft1+i18n('druga.fieldsetoModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="checkbox" style="height: 23px; width: 100%;" class="form-control" id="'+'m_seto'+tdRight2View+Session.get('seto')+tdRight2ViewEnd
                +tdLeft1+i18n('druga.fieldsedmoModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="radio" style="height: 23px; width: 100%;" class="form-control" id="'+'m_sedmo'+tdRight2View+Session.get('sedmo')+tdRight2ViewEnd
                +tFooter);
            case 'edit':
                return Spacebars.SafeString(tHeader
                +tdLeft1+i18n('druga.fieldIdModalLabel')+tdLeft2+tdRight1+'m_id'+tdRight2View+Session.get('_id')+tdRight2ViewEnd
                +tdLeft1+i18n('druga.fieldprvopoljeModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="txt" style="height: 23px; width: 100%;" class="form-control" id="'+'m_prvopolje'+tdRight2View+Session.get('prvopolje')+tdRight2Add
                +tdLeft1+i18n('druga.fielddrugopoljeModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="mail" style="height: 23px; width: 100%;" class="form-control" id="'+'m_drugopolje'+tdRight2View+Session.get('drugopolje')+tdRight2Add
                +tdLeft1+i18n('druga.fieldtreceModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="number" style="height: 23px; width: 100%;" class="form-control" id="'+'m_trece'+tdRight2View+Session.get('trece')+tdRight2Add
                +tdLeft1+i18n('druga.fieldcetvroModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="password" style="height: 23px; width: 100%;" class="form-control" id="'+'m_cetvro'+tdRight2View+Session.get('cetvro')+tdRight2Add
                +tdLeft1+i18n('druga.fieldpetoModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="date" style="height: 23px; width: 100%;" class="form-control" id="'+'m_peto'+tdRight2View+Session.get('peto')+tdRight2Add
                +tdLeft1+i18n('druga.fieldsetoModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="checkbox" style="height: 23px; width: 100%;" class="form-control" id="'+'m_seto'+tdRight2View+Session.get('seto')+tdRight2Add
                +tdLeft1+i18n('druga.fieldsedmoModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="radio" style="height: 23px; width: 100%;" class="form-control" id="'+'m_sedmo'+tdRight2View+Session.get('sedmo')+tdRight2Add
                +tFooter);
            case 'delete':
                return Spacebars.SafeString(tHeader
                +tdLeft1+i18n('druga.fieldIdModalLabel')+tdLeft2+tdRight1+'m_id'+tdRight2View+Session.get('_id')+tdRight2ViewEnd
                +tdLeft1+i18n('druga.fieldprvopoljeModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="txt" style="height: 23px; width: 100%;" class="form-control" id="'+'m_prvopolje'+tdRight2View+Session.get('prvopolje')+tdRight2ViewEnd
                +tdLeft1+i18n('druga.fielddrugopoljeModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="mail" style="height: 23px; width: 100%;" class="form-control" id="'+'m_drugopolje'+tdRight2View+Session.get('drugopolje')+tdRight2ViewEnd
                +tdLeft1+i18n('druga.fieldtreceModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="number" style="height: 23px; width: 100%;" class="form-control" id="'+'m_trece'+tdRight2View+Session.get('trece')+tdRight2ViewEnd
                +tdLeft1+i18n('druga.fieldcetvroModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="password" style="height: 23px; width: 100%;" class="form-control" id="'+'m_cetvro'+tdRight2View+Session.get('cetvro')+tdRight2ViewEnd
                +tdLeft1+i18n('druga.fieldpetoModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="date" style="height: 23px; width: 100%;" class="form-control" id="'+'m_peto'+tdRight2View+Session.get('peto')+tdRight2ViewEnd
                +tdLeft1+i18n('druga.fieldsetoModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="checkbox" style="height: 23px; width: 100%;" class="form-control" id="'+'m_seto'+tdRight2View+Session.get('seto')+tdRight2ViewEnd
                +tdLeft1+i18n('druga.fieldsedmoModalLabel')+tdLeft2 +'<td style="width: 78%;">'
					+'<input type="radio" style="height: 23px; width: 100%;" class="form-control" id="'+'m_sedmo'+tdRight2View+Session.get('sedmo')+tdRight2ViewEnd
                +tFooter);
        }
    },
    modalFooter: function() {
        switch(Session.get("activity")){
            case 'add':
                return new Spacebars.SafeString('<button type="button" class="btn btn-default btn-xs" data-dismiss="modal">'+i18n('druga.modalFooterCancel')+'</button>'
                + '<button id="bAdd" type="button" class="btn btn-success btn-xs">'+i18n('druga.modalFooterAdd')+'</button>');
            case 'view':
                return new Spacebars.SafeString('<button type="button" class="btn btn-default btn-xs" data-dismiss="modal">'+i18n('druga.modalFooterClose')+'</button>');
            case 'edit':
                return new Spacebars.SafeString('<button type="button" class="btn btn-default btn-xs" data-dismiss="modal">'+i18n('druga.modalFooterCancel')+'</button>'
                       + '<button id="bEdit" type="button" class="btn btn-primary btn-xs">'+i18n('druga.modalFooterChange')+'</button>');
            case 'delete':
                return new Spacebars.SafeString('<button type="button" class="btn btn-default btn-xs" data-dismiss="modal">'+i18n('druga.modalFooterNo')+'</button>'
                       + '<button id="bDelete" type="button" class="btn btn-danger btn-xs">'+i18n('druga.modalFooterYes')+'</button>');
        }
    },
    settings: function() {
        return {
            fields: [
                { key: 'bittons', label: '',
                    fn: function (value, object) {
                        return new Spacebars.SafeString('<a data-toggle="modal" data-tooltip="'+i18n('druga.tooltipView')+'" data-target="#modalDruga" onclick="Session.set('+"'activity','view'"+');" class="label label-default tooltip-right"><i class="glyphicon glyphicon-search"></i></a>'
                                +'<a data-toggle="modal" data-tooltip="'+i18n('druga.tooltipEdit')+'" data-target="#modalDruga" onclick="Session.set('+"'activity','edit'"+');" class="label label-primary tooltip-right"><i class="glyphicon glyphicon-edit"></i></a>'
                                +'<a data-toggle="modal" data-tooltip="'+i18n('druga.tooltipDelete')+'" data-target="#modalDruga" onclick="Session.set('+"'activity','delete'"+');" class="label label-danger tooltip-right"><i class="glyphicon glyphicon-remove"></i></a>'
                        );
                    }
                },
                { key: 'prvopolje', label: i18n('druga.fieldprvopoljeGridLabel'), sort: 'asc' },
                { key: 'drugopolje', label: i18n('druga.fielddrugopoljeGridLabel'), sort: 'asc' },
                { key: 'trece', label: i18n('druga.fieldtreceGridLabel'), sort: 'asc' },
                { key: 'cetvro', label: i18n('druga.fieldcetvroGridLabel'), sort: 'asc' },
                { key: 'peto', label: i18n('druga.fieldpetoGridLabel'), sort: 'asc' },
                { key: 'seto', label: i18n('druga.fieldsetoGridLabel'), sort: 'asc' },
                { key: 'sedmo', label: i18n('druga.fieldsedmoGridLabel'), sort: 'asc' }
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

Template.druga.events({
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
        var err = validateInput_Druga();
        if(err == 0){
            try {
                druga.insert({
                       'prvopolje': $('#m_prvopolje').val(),
                       'drugopolje': $('#m_drugopolje').val(),
                       'trece': $('#m_trece').val(),
                       'cetvro': $('#m_cetvro').val(),
                       'peto': $('#m_peto').val(),
                       'seto': $('#m_seto').val(),
                       'sedmo': $('#m_sedmo').val()
            });
                $.growl('<strong>'+i18n('druga.growlSuccessAdd')+'</strong>', {
                    type: 'success', z_index: 99999, allow_dismiss: false
                });
            }
            catch(err) {
                $.growl('<strong>'+i18n('druga.growlError')+'</strong><br />'+err.message, {
                    type: 'danger', z_index: 99999, allow_dismiss: false
                });
            }
            $('#modalDruga').modal('hide');
        }
    },
    'click #bEdit': function(event) {
        var err = validateInput_Druga();
        if(err == 0){
            try {
                druga.update({'_id': Session.get('_id')}, {$set: {
                       'prvopolje': $('#m_prvopolje').val(),
                       'drugopolje': $('#m_drugopolje').val(),
                       'trece': $('#m_trece').val(),
                       'cetvro': $('#m_cetvro').val(),
                       'peto': $('#m_peto').val(),
                       'seto': $('#m_seto').val(),
                       'sedmo': $('#m_sedmo').val()
			}});
                $.growl('<strong>'+i18n('druga.growlSuccessEdit')+'</strong>', {
                    type: 'success', z_index: 99999, allow_dismiss: false
                });
            }
            catch(err) {
                $.growl('<strong>'+i18n('druga.growlError')+'</strong><br />'+err.message, {
                    type: 'danger', z_index: 99999, allow_dismiss: false
                });
            }
            $('#modalDruga').modal('hide');
        }
    },
    'click #bDelete': function(event) {
        try {
            druga.remove({ '_id': Session.get('_id')});
            $.growl('<strong>'+i18n('druga.growlSuccessDelete')+'</strong>', {
                type: 'success', z_index: 99999, allow_dismiss: false
            });
        }
        catch(err) {
            $.growl('<strong>'+i18n('druga.growlError')+'</strong><br />'+err.message, {
                type: 'danger', z_index: 99999, allow_dismiss: false
            });
        }
        $('#modalDruga').modal('hide');
    }
});

Template.druga.rendered = function() {
    $('.reactive-table-filter').html('<div class="row">'
            +'<h3 class="pull-left" style="color: rgb(49, 112, 143);"><em><strong>'+i18n('druga.title')+'</strong></em></h3>'
            +'<h3 class="pull-right"><a data-tooltip="'+i18n('druga.tooltipPrint')+'" class="btn btn-info btn-sm tooltip-left">'+i18n('druga.titlePrint')+'</a>&nbsp;&nbsp;'
            +'<a data-toggle="modal" data-tooltip="'+i18n('druga.tooltipAdd')+'" data-target="#modalDruga" onclick="Session.set(' + "'activity','add'" + ');"class="btn btn-success btn-sm tooltip-left">+</a></h3>'
            +'</div>'
            +$('.reactive-table-filter').html()
    );
    $('#modalDruga').on('shown.bs.modal', function (e) {
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

function validateInput_Druga() {
    var err = 0;
    if($('#m_prvopolje').val().length < 2) {
        $.growl('<strong>'+i18n('druga.growlError')+'</strong><br />'+i18n('druga.fieldprvopoljeGrowlErrorMessage'), {
            type: 'danger', z_index: 99999, allow_dismiss: false
        });
        err++;
    }
    if($('#m_drugopolje').val().length < 2) {
        $.growl('<strong>'+i18n('druga.growlError')+'</strong><br />'+i18n('druga.fielddrugopoljeGrowlErrorMessage'), {
            type: 'danger', z_index: 99999, allow_dismiss: false
        });
        err++;
    }
    if($('#m_trece').val().length < 2) {
        $.growl('<strong>'+i18n('druga.growlError')+'</strong><br />'+i18n('druga.fieldtreceGrowlErrorMessage'), {
            type: 'danger', z_index: 99999, allow_dismiss: false
        });
        err++;
    }
    if($('#m_cetvro').val().length < 2) {
        $.growl('<strong>'+i18n('druga.growlError')+'</strong><br />'+i18n('druga.fieldcetvroGrowlErrorMessage'), {
            type: 'danger', z_index: 99999, allow_dismiss: false
        });
        err++;
    }
    if($('#m_peto').val().length < 2) {
        $.growl('<strong>'+i18n('druga.growlError')+'</strong><br />'+i18n('druga.fieldpetoGrowlErrorMessage'), {
            type: 'danger', z_index: 99999, allow_dismiss: false
        });
        err++;
    }
    if($('#m_seto').val().length < 2) {
        $.growl('<strong>'+i18n('druga.growlError')+'</strong><br />'+i18n('druga.fieldsetoGrowlErrorMessage'), {
            type: 'danger', z_index: 99999, allow_dismiss: false
        });
        err++;
    }
    if($('#m_sedmo').val().length < 2) {
        $.growl('<strong>'+i18n('druga.growlError')+'</strong><br />'+i18n('druga.fieldsedmoGrowlErrorMessage'), {
            type: 'danger', z_index: 99999, allow_dismiss: false
        });
        err++;
    }
    return err;
}
// End of generated file