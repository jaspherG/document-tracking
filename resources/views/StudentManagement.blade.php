@extends('layouts.user_type.auth')

@section('content')
  <div class="row my-2">
    <div class="col-lg-12 col-md-6 mb-md-0 mb-4">
      <div class="card">
        <div class="card-header pb-0">
          <div class="row">
            <div class="col-lg-6 col-7">
              <h6>Student List</h6>
            </div>
            <div class="col-lg-6 col-5 my-auto text-end">
              <div class="dropdown float-lg-end pe-4">
              </div>
            </div>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="table-responsive">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    Name                    
                  </th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    Students No.
                  </th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    Description
                  </th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    Completion
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                <td class="ps-4">
                  <div class="dropdown">
                   <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     Jaspher Gil M. Gutierrez
                   </button>
                   <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                   <div class="dropdown-item">
                   <div class="row mt-2" >
                    <div class="col-12">
                    <div class="card mb-2">
                        <div class="card-header pb-0">
                             <h6>Student Requirements for Admission</h6>
                        </div>
                    <table>
                      <tr>
                        <td>
                          <div class="d-flex px-2">
                            <div class="my-auto">
                              <h6 class="mb-0 text-sm">Grade 10 Report Card</h6>
                            </div>
                          </div>
                        </td>
                        <td class="align-middle text-center">
                          <div class="d-flex align-items-center justify-content-center">
                            <div class="checklist">
                              <input type="checkbox" id="checklist-item-1" name="checklist-item-1">
                            </div>
                          </div>
                        </td>
                        <td class="align-middle">
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-flex px-2">
                            <div class="my-auto">
                              <h6 class="mb-0 text-sm">Grade 11 Report Card</h6>
                            </div>
                          </div>
                        </td>
                        <td class="align-middle text-center">
                          <div class="d-flex align-items-center justify-content-center">
                            <div class="checklist">
                              <input type="checkbox" id="checklist-item-1" name="checklist-item-1">
                            </div>
                          </div>
                        </td>
                        <td class="align-middle">
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-flex px-2">
                            <div class="my-auto">
                              <h6 class="mb-0 text-sm">Grade 12 Report Card</h6>
                            </div>
                          </div>
                        </td>
                        <td class="align-middle text-center">
                          <div class="d-flex align-items-center justify-content-center">
                            <div class="checklist">
                              <input type="checkbox" id="checklist-item-1" name="checklist-item-1">
                            </div>
                          </div>
                        </td>
                        <td class="align-middle">
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-flex px-2">
                            <div class="my-auto">
                              <h6 class="mb-0 text-sm">Good Moral</h6>
                            </div>
                          </div>
                        </td>
                        <td class="align-middle text-center">
                          <div class="d-flex align-items-center justify-content-center">
                            <div class="checklist">
                              <input type="checkbox" id="checklist-item-1" name="checklist-item-1">
                            </div>
                          </div>
                        </td>
                        <td class="align-middle">
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-flex px-2">
                            <div class="my-auto">
                              <h6 class="mb-0 text-sm">X-ray & Medical Certificate</h6>
                            </div>
                          </div>
                        </td>
                        <td class="align-middle text-center">
                          <div class="d-flex align-items-center justify-content-center">
                            <div class="checklist">
                              <input type="checkbox" id="checklist-item-1" name="checklist-item-1">
                            </div>
                          </div>
                        </td>
                        <td class="align-middle">
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-flex px-2">
                            <div class="my-auto">
                              <h6 class="mb-0 text-sm">Original PSA Birthcertificate</h6>
                            </div>
                          </div>
                        </td>
                        <td class="align-middle text-center">
                          <div class="d-flex align-items-center justify-content-center">
                            <div class="checklist">
                              <input type="checkbox" id="checklist-item-1" name="checklist-item-1">
                            </div>
                          </div>
                        </td>
                        <td class="align-middle">
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-flex px-2">
                            <div class="my-auto">
                              <h6 class="mb-0 text-sm">Form 137-A Copy for PUP Bansud</h6>
                            </div>
                          </div>
                        </td>
                        <td class="align-middle text-center">
                          <div class="d-flex align-items-center justify-content-center">
                            <div class="checklist">
                              <input type="checkbox" id="checklist-item-1" name="checklist-item-1">
                            </div>
                          </div>
                        </td>
                        <td class="align-middle">
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-flex px-2">
                            <div class="my-auto">
                              <h6 class="mb-0 text-sm">SARF</h6>
                            </div>
                          </div>
                        </td>
                        <td class="align-middle text-center">
                          <div class="d-flex align-items-center justify-content-center">
                            <div class="checklist">
                              <input type="checkbox" id="checklist-item-1" name="checklist-item-1">
                            </div>
                          </div>
                        </td>
                        <td class="align-middle">
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-flex px-2">
                            <div class="my-auto">
                              <h6 class="mb-0 text-sm">Affidavit of Non-Enrollment</h6>
                            </div>
                          </div>
                        </td>
                        <td class="align-middle text-center">
                          <div class="d-flex align-items-center justify-content-center">
                            <div class="checklist">
                              <input type="checkbox" id="checklist-item-1" name="checklist-item-1">
                            </div>
                          </div>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="d-flex justify-content-end">
                <button type="submit" class="btn bg-gradient-dark btn-md mt-1 mb-1">{{ 'Received By' }}</button>
                  </div>
                </div>
                 </td>
                  <td class="text-uppercase">  
                      <p class="text-xs font-weight-bold mb-0">2020-00091-BS-0</p>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-xs font-weight-bold"> BSIT</span>
                  </td>
                  <td class="align-middle">
                    <div class="progress-wrapper w-75 mx-auto">
                      <div class="progress-info">
                        <div class="progress-percentage">
                          <span class="text-xs font-weight-bold">60%</span>
                        </div>
                      </div>
                      <div class="progress">
                        <div class="progress-bar bg-gradient-info w-60" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                <tr>
                <td class="ps-4">
                  <div class="dropdown">
                   <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     Jemar Bombales
                   </button>
                   <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                   <div class="dropdown-item">
                   <div class="row mt-2" >
                    <div class="col-12">
                    <div class="card mb-2">
                        <div class="card-header pb-0">
                             <h6>Student Requirements for Re-Admission/Returnee</h6>
                        </div>
                    <table>
                      <tr>
                        <td>
                          <div class="d-flex px-2">
                            <div class="my-auto">
                              <h6 class="mb-0 text-sm">Informative Grades</h6>
                            </div>
                          </div>
                        </td>
                        <td class="align-middle text-center">
                          <div class="d-flex align-items-center justify-content-center">
                            <div class="checklist">
                              <input type="checkbox" id="checklist-item-1" name="checklist-item-1">
                            </div>
                          </div>
                        </td>
                        <td class="align-middle">
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-flex px-2">
                            <div class="my-auto">
                              <h6 class="mb-0 text-sm">Medical Certificate</h6>
                            </div>
                          </div>
                        </td>
                        <td class="align-middle text-center">
                          <div class="d-flex align-items-center justify-content-center">
                            <div class="checklist">
                              <input type="checkbox" id="checklist-item-1" name="checklist-item-1">
                            </div>
                          </div>
                        </td>
                        <td class="align-middle">
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-flex px-2">
                            <div class="my-auto">
                              <h6 class="mb-0 text-sm">Re-Admission Form</h6>
                            </div>
                          </div>
                        </td>
                        <td class="align-middle text-center">
                          <div class="d-flex align-items-center justify-content-center">
                            <div class="checklist">
                              <input type="checkbox" id="checklist-item-1" name="checklist-item-1">
                            </div>
                          </div>
                        </td>
                        <td class="align-middle">
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-flex px-2">
                            <div class="my-auto">
                              <h6 class="mb-0 text-sm">Letter of Intent</h6>
                            </div>
                          </div>
                        </td>
                        <td class="align-middle text-center">
                          <div class="d-flex align-items-center justify-content-center">
                            <div class="checklist">
                              <input type="checkbox" id="checklist-item-1" name="checklist-item-1">
                            </div>
                          </div>
                        </td>
                        <td class="align-middle">
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-flex px-2">
                            <div class="my-auto">
                              <h6 class="mb-0 text-sm">Admission Certificate</h6>
                            </div>
                          </div>
                        </td>
                        <td class="align-middle text-center">
                          <div class="d-flex align-items-center justify-content-center">
                            <div class="checklist">
                              <input type="checkbox" id="checklist-item-1" name="checklist-item-1">
                            </div>
                          </div>
                        </td>
                        <td class="align-middle">
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-flex px-2">
                            <div class="my-auto">
                              <h6 class="mb-0 text-sm">Evaluation</h6>
                            </div>
                          </div>
                        </td>
                        <td class="align-middle text-center">
                          <div class="d-flex align-items-center justify-content-center">
                            <div class="checklist">
                              <input type="checkbox" id="checklist-item-1" name="checklist-item-1">
                            </div>
                          </div>
                        </td>
                        <td class="align-middle">
                        </td>
                      </tr>
                  </table>
                 </div>
                <div class="d-flex justify-content-end">
                  <button type="submit" class="btn bg-gradient-dark btn-md mt-1 mb-1">{{ 'Received By' }}</button>
                </div>
                <div>
                <form action="upload.php" method="post" enctype="multipart/form-data">
                  <input type="file" name="file" id="file" required>
                  <button type="submit" class="btn bg-gradient-dark btn-md mt-0 mb-0" name="submit">Upload</button>
                </form>
                </div>
                </div>
                 </td>
                  <td class="text-uppercase">  
                      <p class="text-xs font-weight-bold mb-0">2020-00091-BS-0</p>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-xs font-weight-bold"> BSIT</span>
                  </td>
                  <td class="align-middle">
                    <div class="progress-wrapper w-75 mx-auto">
                      <div class="progress-info">
                        <div class="progress-percentage">
                          <span class="text-xs font-weight-bold">60%</span>
                        </div>
                      </div>
                      <div class="progress">
                        <div class="progress-bar bg-gradient-info w-60" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                <tr>
                <td class="ps-4">
                  <div class="dropdown">
                   <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     Elijah Rotoni
                   </button>
                   <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                   <div class="dropdown-item">
                   <div class="row mt-2" >
                    <div class="col-12">
                    <div class="card mb-2">
                        <div class="card-header pb-0">
                             <h6>Student Requirements for Transferee</h6>
                        </div>
                    <table>
                      <tr>
                        <td>
                          <div class="d-flex px-2">
                            <div class="my-auto">
                              <h6 class="mb-0 text-sm">TOR</h6>
                            </div>
                          </div>
                        </td>
                        <td class="align-middle text-center">
                          <div class="d-flex align-items-center justify-content-center">
                            <div class="checklist">
                              <input type="checkbox" id="checklist-item-1" name="checklist-item-1">
                            </div>
                          </div>
                        </td>
                        <td class="align-middle">
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-flex px-2">
                            <div class="my-auto">
                              <h6 class="mb-0 text-sm">Good Moral</h6>
                            </div>
                          </div>
                        </td>
                        <td class="align-middle text-center">
                          <div class="d-flex align-items-center justify-content-center">
                            <div class="checklist">
                              <input type="checkbox" id="checklist-item-1" name="checklist-item-1">
                            </div>
                          </div>
                        </td>
                        <td class="align-middle">
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-flex px-2">
                            <div class="my-auto">
                              <h6 class="mb-0 text-sm">Honorable Dismissal</h6>
                            </div>
                          </div>
                        </td>
                        <td class="align-middle text-center">
                          <div class="d-flex align-items-center justify-content-center">
                            <div class="checklist">
                              <input type="checkbox" id="checklist-item-1" name="checklist-item-1">
                            </div>
                          </div>
                        </td>
                        <td class="align-middle">
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-flex px-2">
                            <div class="my-auto">
                              <h6 class="mb-0 text-sm">Waiver for Transferee</h6>
                            </div>
                          </div>
                        </td>
                        <td class="align-middle text-center">
                          <div class="d-flex align-items-center justify-content-center">
                            <div class="checklist">
                              <input type="checkbox" id="checklist-item-1" name="checklist-item-1">
                            </div>
                          </div>
                        </td>
                        <td class="align-middle">
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-flex px-2">
                            <div class="my-auto">
                              <h6 class="mb-0 text-sm">X-ray Medical Certificate</h6>
                            </div>
                          </div>
                        </td>
                        <td class="align-middle text-center">
                          <div class="d-flex align-items-center justify-content-center">
                            <div class="checklist">
                              <input type="checkbox" id="checklist-item-1" name="checklist-item-1">
                            </div>
                          </div>
                        </td>
                        <td class="align-middle">
                        </td>
                      </tr>
                    </table>
                 </div>
                 <div class="d-flex justify-content-end">
                  <button type="submit" class="btn bg-gradient-dark btn-md mt-1 mb-1">{{ 'Received By' }}</button>
                </div>
                </div>
                 </td>
                  <td class="text-uppercase">  
                      <p class="text-xs font-weight-bold mb-0">2020-00091-BS-0</p>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-xs font-weight-bold"> BSIT</span>
                  </td>
                  <td class="align-middle">
                    <div class="progress-wrapper w-75 mx-auto">
                      <div class="progress-info">
                        <div class="progress-percentage">
                          <span class="text-xs font-weight-bold">60%</span>
                        </div>
                      </div>
                      <div class="progress">
                        <div class="progress-bar bg-gradient-info w-60" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                <tr>
                <td class="ps-4">
                  <div class="dropdown">
                   <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     Desire Manalo
                   </button>
                   <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                   <div class="dropdown-item">
                   <div class="row mt-2" >
                    <div class="col-12">
                    <div class="card mb-2">
                        <div class="card-header pb-0">
                             <h6>Student Requirements for Cross-Enroll</h6>
                        </div>
                    <table>
                      <tr>
                        <td>
                          <div class="d-flex px-2">
                            <div class="my-auto">
                              <h6 class="mb-0 text-sm">Request student</h6>
                            </div>
                          </div>
                        </td>
                        <td class="align-middle text-center">
                          <div class="d-flex align-items-center justify-content-center">
                            <div class="checklist">
                              <input type="checkbox" id="checklist-item-1" name="checklist-item-1">
                            </div>
                          </div>
                        </td>
                        <td class="align-middle">
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-flex px-2">
                            <div class="my-auto">
                              <h6 class="mb-0 text-sm">Cross Enroll Form</h6>
                            </div>
                          </div>
                        </td>
                        <td class="align-middle text-center">
                          <div class="d-flex align-items-center justify-content-center">
                            <div class="checklist">
                              <input type="checkbox" id="checklist-item-1" name="checklist-item-1">
                            </div>
                          </div>
                        </td>
                        <td class="align-middle">
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-flex px-2">
                            <div class="my-auto">
                              <h6 class="mb-0 text-sm">Curriculum Sheet</h6>
                            </div>
                          </div>
                        </td>
                        <td class="align-middle text-center">
                          <div class="d-flex align-items-center justify-content-center">
                            <div class="checklist">
                              <input type="checkbox" id="checklist-item-1" name="checklist-item-1">
                            </div>
                          </div>
                        </td>
                        <td class="align-middle">
                        </td>
                      </tr>
                    </table>
                 </div>
                 <div class="d-flex justify-content-end">
                  <button type="submit" class="btn bg-gradient-dark btn-md mt-1 mb-1">{{ 'Received By' }}</button>
                </div>
                 </td>
                  <td class="text-uppercase">  
                      <p class="text-xs font-weight-bold mb-0">2020-00091-BS-0</p>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-xs font-weight-bold"> BSIT</span>
                  </td>
                  <td class="align-middle">
                    <div class="progress-wrapper w-75 mx-auto">
                      <div class="progress-info">
                        <div class="progress-percentage">
                          <span class="text-xs font-weight-bold">60%</span>
                        </div>
                      </div>
                      <div class="progress">
                        <div class="progress-bar bg-gradient-info w-60" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                <tr>
                <td class="ps-4">
                  <div class="dropdown">
                   <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     Rosaly Supleo
                   </button>
                   <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                   <div class="dropdown-item">
                   <div class="row mt-2" >
                    <div class="col-12">
                    <div class="card mb-2">
                        <div class="card-header pb-0">
                             <h6>Student Requirements for Shiftee</h6>
                        </div>
                    <table>
                      <tr>
                        <td>
                          <div class="d-flex px-2">
                            <div class="my-auto">
                              <h6 class="mb-0 text-sm">Curriculum Sheet</h6>
                            </div>
                          </div>
                        </td>
                        <td class="align-middle text-center">
                          <div class="d-flex align-items-center justify-content-center">
                            <div class="checklist">
                              <input type="checkbox" id="checklist-item-1" name="checklist-item-1">
                            </div>
                          </div>
                        </td>
                        <td class="align-middle">
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-flex px-2">
                            <div class="my-auto">
                              <h6 class="mb-0 text-sm">Form Shiftee</h6>
                            </div>
                          </div>
                        </td>
                        <td class="align-middle text-center">
                          <div class="d-flex align-items-center justify-content-center">
                            <div class="checklist">
                              <input type="checkbox" id="checklist-item-1" name="checklist-item-1">
                            </div>
                          </div>
                        </td>
                        <td class="align-middle">
                        </td>
                      </tr>
                    </table>
                 </div>
                 <div class="d-flex justify-content-end">
                  <button type="submit" class="btn bg-gradient-dark btn-md mt-1 mb-1">{{ 'Received By' }}</button>
                </div>
                 </td>
                  <td class="text-uppercase">  
                      <p class="text-xs font-weight-bold mb-0">2020-00091-BS-0</p>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-xs font-weight-bold"> BSIT</span>
                  </td>
                  <td class="align-middle">
                    <div class="progress-wrapper w-75 mx-auto">
                      <div class="progress-info">
                        <div class="progress-percentage">
                          <span class="text-xs font-weight-bold">60%</span>
                        </div>
                      </div>
                      <div class="progress">
                        <div class="progress-bar bg-gradient-info w-60" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                <tr>
                <td class="ps-4">
                  <div class="dropdown">
                   <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     Natsy Dagus
                   </button>
                   <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <div class="dropdown-item">
                   <div class="row mt-2" >
                    <div class="col-12">
                    <div class="card mb-2">
                        <div class="card-header pb-0">
                             <h6>Student Requirements for Cross-Enroll</h6>
                        </div>
                    <table>
                      <tr>
                        <td>
                          <div class="d-flex px-2">
                            <div class="my-auto">
                              <h6 class="mb-0 text-sm">Request student</h6>
                            </div>
                          </div>
                        </td>
                        <td class="align-middle text-center">
                          <div class="d-flex align-items-center justify-content-center">
                            <div class="checklist">
                              <input type="checkbox" id="checklist-item-1" name="checklist-item-1">
                            </div>
                          </div>
                        </td>
                        <td class="align-middle">
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-flex px-2">
                            <div class="my-auto">
                              <h6 class="mb-0 text-sm">Cross Enroll Form</h6>
                            </div>
                          </div>
                        </td>
                        <td class="align-middle text-center">
                          <div class="d-flex align-items-center justify-content-center">
                            <div class="checklist">
                              <input type="checkbox" id="checklist-item-1" name="checklist-item-1">
                            </div>
                          </div>
                        </td>
                        <td class="align-middle">
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-flex px-2">
                            <div class="my-auto">
                              <h6 class="mb-0 text-sm">Curriculum Sheet</h6>
                            </div>
                          </div>
                        </td>
                        <td class="align-middle text-center">
                          <div class="d-flex align-items-center justify-content-center">
                            <div class="checklist">
                              <input type="checkbox" id="checklist-item-1" name="checklist-item-1">
                            </div>
                          </div>
                        </td>
                        <td class="align-middle">
                        </td>
                      </tr>
                    </table>
                 </div>
                 <div class="d-flex justify-content-end">
                  <button type="submit" class="btn bg-gradient-dark btn-md mt-1 mb-1">{{ 'Received By' }}</button>
                </div>
                 </td>
                  <td class="text-uppercase">  
                      <p class="text-xs font-weight-bold mb-0">2020-00091-BS-0</p>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-xs font-weight-bold"> BSIT</span>
                  </td>
                  <td class="align-middle">
                    <div class="progress-wrapper w-75 mx-auto">
                      <div class="progress-info">
                        <div class="progress-percentage">
                          <span class="text-xs font-weight-bold">60%</span>
                        </div>
                      </div>
                      <div class="progress">
                        <div class="progress-bar bg-gradient-info w-60" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

@endsection


