@extends('master.theme')

@section('content')
@if(Auth::user()->type=='admin')
<style type="text/css">
  body{font-size: 20px!important;}
  .span_required { color:red  }
  td{height: 50px !important;}
  .topLeft{text-align:left;vertical-align:top;padding-bottom: 5px;}
  .topCenter{text-align:center;vertical-align:top;padding-bottom: 5px;}
</style>

@if(session()->has('yes')) <div class="col-md-12"><div class="alert alert-success">{{ session()->get('yes') }}</div></div> @endif
@if(session()->has('no')) <div class="col-md-12"><div class="alert alert-danger">{{ session()->get('no') }}</div></div> @endif

@foreach($resign as $i)
<div class="col-md-12 grid-margin stretch-card formular">
  <div class="card">
    <div class="card-body">
      <a target="_blank" href="{{ route('resign_checklist', ['ref' => $i->ref]) }}"><button type="button" class="btn btn-primary btn-icon-text btn-md mb-3"><i class=" mdi mdi-printer btn-icon-prepend"></i>Print</button></a>
      <form method="POST" action="{{ route('manager_resign_checklist_updated', ['ref' => $i->ref]) }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row">
          <div class="col-md-6 grid-margin stretch-card formular">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <h4 class="card-title">Internal Communications</h4>
                    <table class="table table-striped table-hover">
                      <thead>
                        <tr>
                          <td class="topCenter" style="width: 6%;">No</td>
                          <td class="topCenter">Question</td>
                          <td class="topCenter">Mark</td>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="topCenter">1</td>
                          <td class="topLeft">Thank the employee for their contributions to your business, regardless of the circumstances of their departure</td>
                          <td class="topCenter"><input type="checkbox" class="form-check-input " name="a1" id="a1" value="Yes" @if($i->a1=='Yes') checked @endif></td>
                        </tr>
                        <tr>
                          <td class="topCenter">2</td>
                          <td class="topLeft">Inform all relevant internal stakeholders that offboarding is being initiated</td>
                          <td class="topCenter"><input type="checkbox" class="form-check-input " name="a2" id="a2" value="Yes" @if($i->a2=='Yes') checked @endif></td>
                        </tr>
                        <tr>
                          <td class="topCenter">3</td>
                          <td class="topLeft">Notify HR to prepare relevant paperwork, final paychecks, and termination of benefits</td>
                          <td class="topCenter"><input type="checkbox" class="form-check-input " name="a3" id="a3" value="Yes" @if($i->a3=='Yes') checked @endif></td>
                        </tr>
                        <tr>
                          <td class="topCenter">4</td>
                          <td class="topLeft">Outline the offboarding process to the employee</td>
                          <td class="topCenter"><input type="checkbox" class="form-check-input " name="a4" id="a4" value="Yes" @if($i->a4=='Yes') checked @endif></td>
                        </tr>
                        <tr>
                          <td class="topCenter">5</td>
                          <td class="topLeft">Inform the employee's team members and the wider company of their departure and finish date</td>
                          <td class="topCenter"><input type="checkbox" class="form-check-input " name="a5" id="a5" value="Yes" @if($i->a5=='Yes') checked @endif></td>
                        </tr>
                        <tr>
                          <td class="topCenter">6</td>
                          <td class="topLeft">Create a transition plan</td>
                          <td class="topCenter"><input type="checkbox" class="form-check-input " name="a6" id="a6" value="Yes" @if($i->a6=='Yes') checked @endif></td>
                        </tr>
                        <tr>
                          <td class="topCenter">7</td>
                          <td class="topLeft">Schedule an exit interview</td>
                          <td class="topCenter"><input type="checkbox" class="form-check-input " name="a7" id="a7" value="Yes" @if($i->a7=='Yes') checked @endif></td>
                        </tr>
                        <tr>
                          <td class="topCenter">8</td>
                          <td class="topLeft">Initiate the process of recruiting for the employee's position, if applicable</td>
                          <td class="topCenter"><input type="checkbox" class="form-check-input " name="a8" id="a8" value="Yes" @if($i->a8=='Yes') checked @endif></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 grid-margin stretch-card formular">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <h4 class="card-title">Handover Process</h4>
                    <table class="table table-striped table-hover">
                      <thead>
                        <tr>
                          <td class="topCenter" style="width: 6%;">No</td>
                          <td class="topCenter">Question</td>
                          <td class="topCenter">Mark</td>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="topCenter">1</td>
                          <td class="topLeft">Create an offboarding messaging channel to keep all stakeholders informed of the handover process</td>
                          <td class="topCenter"><input type="checkbox" class="form-check-input " name="b1" id="b1" value="Yes" @if($i->b1=='Yes') checked @endif></td>
                        </tr>
                        <tr>
                          <td class="topCenter">2</td>
                          <td class="topLeft">Ask the employee to document any required knowledge transfer</td>
                          <td class="topCenter"><input type="checkbox" class="form-check-input " name="b2" id="b2" value="Yes" @if($i->b2=='Yes') checked @endif></td>
                        </tr>
                        <tr>
                          <td class="topCenter">3</td>
                          <td class="topLeft">Determine which team members will take over the departing employee's responsibilities, if applicable</td>
                          <td class="topCenter"><input type="checkbox" class="form-check-input " name="b3" id="b3" value="Yes" @if($i->b3=='Yes') checked @endif></td>
                        </tr>
                        <tr>
                          <td class="topCenter">4</td>
                          <td class="topLeft">Inform team members of any temporary redistribution of responsibilities, re-routing of emails, etc.</td>
                          <td class="topCenter"><input type="checkbox" class="form-check-input " name="b4" id="b4" value="Yes" @if($i->b4=='Yes') checked @endif></td>
                        </tr>
                        <tr>
                          <td class="topCenter">5</td>
                          <td class="topLeft">Notify internal and external stakeholders of their updated point of contact</td>
                          <td class="topCenter"><input type="checkbox" class="form-check-input " name="b5" id="b5" value="Yes" @if($i->b5=='Yes') checked @endif></td>
                        </tr>
                        <tr>
                          <td class="topCenter">6</td>
                          <td class="topLeft">Schedule handover meetings with internal stakeholders, as required</td>
                          <td class="topCenter"><input type="checkbox" class="form-check-input " name="b6" id="b6" value="Yes" @if($i->b6=='Yes') checked @endif></td>
                        </tr>
                        <tr>
                          <td class="topCenter">7</td>
                          <td class="topLeft">Schedule handover meetings with external clients, as required</td>
                          <td class="topCenter"><input type="checkbox" class="form-check-input " name="b7" id="b7" value="Yes" @if($i->b7=='Yes') checked @endif></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 grid-margin stretch-card formular">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <h4 class="card-title">Device and System Access</h4>
                    <table class="table table-striped table-hover">
                      <thead>
                        <tr>
                          <td class="topCenter" style="width: 6%;">No</td>
                          <td class="topCenter">Question</td>
                          <td class="topCenter">Mark</td>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="topCenter">1</td>
                          <td class="topLeft">Create a list of all company devices, equipment, access cards, etc. to retrieve, if one does not already exist</td>
                          <td class="topCenter"><input type="checkbox" class="form-check-input " name="c1" id="c1" value="Yes" @if($i->c1=='Yes') checked @endif></td>
                        </tr>
                        <tr>
                          <td class="topCenter">2</td>
                          <td class="topLeft">Inform the employee of when and where this equipment must be returned</td>
                          <td class="topCenter"><input type="checkbox" class="form-check-input " name="c2" id="c2" value="Yes" @if($i->c2=='Yes') checked @endif></td>
                        </tr>
                        <tr>
                          <td class="topCenter">3</td>
                          <td class="topLeft">Create a list of all apps and files the employee has access to, if one does not already exist</td>
                          <td class="topCenter"><input type="checkbox" class="form-check-input " name="c3" id="c3" value="Yes" @if($i->c3=='Yes') checked @endif></td>
                        </tr>
                        <tr>
                          <td class="topCenter">4</td>
                          <td class="topLeft">Inform the employee of when their access to company resources will be revoked</td>
                          <td class="topCenter"><input type="checkbox" class="form-check-input " name="c4" id="c4" value="Yes" @if($i->c4=='Yes') checked @endif></td>
                        </tr>
                        <tr>
                          <td class="topCenter">5</td>
                          <td class="topLeft">Identify any files or systems that the employee has sole ownership of, and arrange for transfer of ownership</td>
                          <td class="topCenter"><input type="checkbox" class="form-check-input " name="c5" id="c5" value="Yes" @if($i->c5=='Yes') checked @endif></td>
                        </tr>
                        <tr>
                          <td class="topCenter">6</td>
                          <td class="topLeft">Reset two-factor authentication (2FA) to remove the departing employee's contact details</td>
                          <td class="topCenter"><input type="checkbox" class="form-check-input " name="c6" id="c6" value="Yes" @if($i->c6=='Yes') checked @endif></td>
                        </tr>
                        <tr>
                          <td class="topCenter">7</td>
                          <td class="topLeft">If operating BYOD (Bring Your Own Device), arrange for company files and access to be removed from the employee's personal devices</td>
                          <td class="topCenter"><input type="checkbox" class="form-check-input " name="c7" id="c7" value="Yes" @if($i->c7=='Yes') checked @endif></td>
                        </tr>
                        <tr>
                          <td class="topCenter">8</td>
                          <td class="topLeft">Revoke and reset all system, app, and software access on the appropriate date</td>
                          <td class="topCenter"><input type="checkbox" class="form-check-input " name="c8" id="c8" value="Yes" @if($i->c8=='Yes') checked @endif></td>
                        </tr>
                        <tr>
                          <td class="topCenter">9</td>
                          <td class="topLeft">Deactivate the employee's profiles on company apps, such as Slack</td>
                          <td class="topCenter"><input type="checkbox" class="form-check-input " name="c9" id="c9" value="Yes" @if($i->c9=='Yes') checked @endif></td>
                        </tr>
                        <tr>
                          <td class="topCenter">10</td>
                          <td class="topLeft">Re-route employee emails and any other critical communications on the appropriate date</td>
                          <td class="topCenter"><input type="checkbox" class="form-check-input " name="c10" id="c10" value="Yes" @if($i->c10=='Yes') checked @endif></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 grid-margin stretch-card formular">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <h4 class="card-title">Remote Employees</h4>
                      <table class="table table-striped table-hover">
                        <thead>
                          <tr>
                            <td class="topCenter" style="width: 6%;">No</td>
                            <td class="topCenter">Question</td>
                            <td class="topCenter">Mark</td>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="topCenter">1</td>
                            <td class="topLeft">Ensure all handover meetings and exit interviews are scheduled virtually</td>
                            <td class="topCenter"><input type="checkbox" class="form-check-input " name="d1" id="d1" value="Yes" @if($i->d1=='Yes') checked @endif></td>
                          </tr>
                          <tr>
                            <td class="topCenter">2</td>
                            <td class="topLeft">Arrange for all company equipment to be returned by courier, if applicable</td>
                            <td class="topCenter"><input type="checkbox" class="form-check-input " name="d2" id="d2" value="Yes" @if($i->d2=='Yes') checked @endif></td>
                          </tr>
                          <tr>
                            <td class="topCenter">3</td>
                            <td class="topLeft">Remotely wipe or secure company devices before they are transferred to a courier</td>
                            <td class="topCenter"><input type="checkbox" class="form-check-input " name="d3" id="d3" value="Yes" @if($i->d3=='Yes') checked @endif></td>
                          </tr>
                          <tr>
                            <td class="topCenter">4</td>
                            <td class="topLeft">Terminate VPN access</td>
                            <td class="topCenter"><input type="checkbox" class="form-check-input " name="d4" id="d4" value="Yes" @if($i->d4=='Yes') checked @endif></td>
                          </tr>
                        </tbody>
                      </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 grid-margin stretch-card formular">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <h4 class="card-title">Exit Interview</h4>
                    <table class="table table-striped table-hover">
                      <thead>
                        <tr>
                          <td class="topCenter" style="width: 6%;">No</td>
                          <td class="topCenter">Question</td>
                          <td class="topCenter">Mark</td>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="topCenter">1</td>
                          <td class="topLeft">Perform exit interview and document all feedback</td>
                          <td class="topCenter"><input type="checkbox" class="form-check-input " name="e1" id="e1" value="Yes" @if($i->e1=='Yes') checked @endif></td>
                        </tr>
                        <tr>
                          <td class="topCenter">2</td>
                          <td class="topLeft">Provide employer reference and other exit documentation, as required</td>
                          <td class="topCenter"><input type="checkbox" class="form-check-input " name="e2" id="e2" value="Yes" @if($i->e2=='Yes') checked @endif></td>
                        </tr>
                        <tr>
                          <td class="topCenter">3</td>
                          <td class="topLeft">Update employee's contact details so they can be reached in future if needed</td>
                          <td class="topCenter"><input type="checkbox" class="form-check-input " name="e3" id="e3" value="Yes" @if($i->e3=='Yes') checked @endif></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-success btn-icon-text btn-md "><i class=" mdi mdi-content-save btn-icon-prepend"></i>Save</button>
      </form>
    </div>
  </div>
</div>
@endforeach
@endif
@endsection