<?php

$this->title = 'Registration';
?>

<div class="col-12" style="margin-top: 90px;">
    <div class="col-12 page-register-qs">
        Registration
        <div class="Sub-category">
            category & Sub-category
        </div>
    </div>
    <div class="col-12 mt-30">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="col-12">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label"> <span class="moon-n1">*</span> Master Questioner Name</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                    </div>
                </div>
                <div class="col-12">
                    <label for="exampleFormControlInput1" class="form-label"> <span class="moon-n1">*</span> Type</label>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="1">Rating Scale Method</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                    <div class="col-12 text-danger mt-10 pl-10">
                        If Ranking Scale Method
                    </div>
                    <div class="col-12">
                        <div class="scrollbar mt-20" id="style-2">
                            <div class="force-overflow">
                                <div class="col-12 regis-rating">
                                    Rating Scale Method
                                </div>
                                <div class="col-12 regis-select-rating">
                                    Select Rating Scale Limit
                                </div>
                                <div class="col-12 mt-10">
                                    <div class="position-relative m-4">
                                        <div class="progress" style="height: 1px;">
                                            <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <button type="button" class="position-absolute top-0 start-0 translate-middle btn btn-sm btn-primary rounded-pill" style="width: 2rem; height:2rem;">1</button>
                                        <button type="button" class="position-absolute top-0 start-50 translate-middle btn btn-sm btn-primary rounded-pill" style="width: 2rem; height:2rem;">2</button>
                                        <button type="button" class="position-absolute top-0 start-100 translate-middle btn btn-sm btn-secondary rounded-pill" style="width: 2rem; height:2rem;">3</button>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-4">
                                        <div class="col-12 pl-10" style="font-weight: bold;">
                                            RANK
                                        </div>
                                        <div class="col-12 sero">
                                            01
                                        </div>
                                        <div class="col-12 sero">
                                            02
                                        </div>
                                        <div class="col-12 sero">
                                            03
                                        </div>
                                        <div class="col-12 sero">
                                            04
                                        </div>
                                        <div class="col-12 sero">
                                            05
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-6 col-4">
                                        <div class="col-12" style="font-weight: bold;">
                                            DETAILS
                                        </div>
                                        <div class="col-12 exampleInput-text">
                                            <input type="text" class="form-control" id="exampleInput" aria-describedby="" placeholder="Poor">
                                        </div>
                                        <div class="col-12 exampleInput-text">
                                            <input type="text" class="form-control" id="exampleInput" aria-describedby="" placeholder="Needs Improvement">
                                        </div>
                                        <div class="col-12 exampleInput-text">
                                            <input type="text" class="form-control" id="exampleInput" aria-describedby="" placeholder="Okay">
                                        </div>
                                        <div class="col-12 exampleInput-text">
                                            <input type="text" class="form-control" id="exampleInput" aria-describedby="" placeholder="Good">
                                        </div>
                                        <div class="col-12 exampleInput-text">
                                            <input type="text" class="form-control" id="exampleInput" aria-describedby="" placeholder="Very Good">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 name-Description">
                        Questionnaire Description
                    </div>
                    <div class="alert alert-light mt-10">
                        <div class="row">
                            <div class="col-1 icon-sml">
                                <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
                                <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
                            </div>
                            <div class="col-2">
                                <span>
                                    <select class="form-select sl-font" aria-label="Default select example">
                                        <option selected>Verdana</option>
                                        <option value="1">Calibri</option>
                                        <option value="2">Angsana New</option>
                                        <option value="3">Klavika Bd</option>
                                    </select>
                                </span>
                            </div>
                            <div class="col-1">
                                <span>
                                    <select class="form-select sl-size" aria-label="Default select example">
                                        <option selected>8</option>
                                        <option value="1">9</option>
                                        <option value="2">10</option>
                                        <option value="3">11</option>
                                        <option value="3">12</option>
                                        <option value="3">13</option>
                                        <option value="3">14</option>
                                        <option value="3">15</option>
                                        <option value="3">16</option>
                                        <option value="3">17</option>
                                    </select>
                                </span>
                            </div>
                            <div class="col-1">
                                <input type="color" class="form-control form-control-color coolor" id="exampleColorInput" value="#563d7c" title="Choose your color">
                            </div>
                            <div class="col-7">
                                <span> <i class="fa fa-bold from-add" aria-hidden="true"></i></span>&nbsp;
                                <span> <i class="fa fa-underline from-add" aria-hidden="true"></i></span>&nbsp;
                                <span> <i class="fa fa-italic from-add" aria-hidden="true"></i></span>&nbsp;
                                <span> <i class="fa fa-strikethrough from-add" aria-hidden="true"></i></span>&nbsp;
                                <span> <i class="fa fa-align-left  from-add" aria-hidden="true"></i></span>&nbsp;
                                <span> <i class="fa fa-eraser  from-add" aria-hidden="true"></i> </span>&nbsp;
                                <span> <i class="fa fa-align-center  from-add" aria-hidden="true"></i></span>&nbsp;
                                <span> <i class="fa fa-align-right  from-add" aria-hidden="true"></i></span>&nbsp;
                                <span> <i class="fa fa-align-justify from-add" aria-hidden="true"></i></span>&nbsp;
                                <span> <i class="fa fa-picture-o  from-add" aria-hidden="true"></i></span>&nbsp;
                                <span> <i class="fa fa-link  from-add" aria-hidden="true"></i></span>&nbsp;
                                <span> <i class="fa fa-list-ul  from-add" aria-hidden="true"></i></span>&nbsp;
                                <span> <i class="fa fa-list-ol  from-add" aria-hidden="true"></i></span>&nbsp;
                                <span> <i class="fa fa-code from-add" aria-hidden="true"></i> </span>
                                <span> <i class="fa fa-quote-left from-add" aria-hidden="true"></i></span>
                            </div>
                            <hr class="mt-10">
                            <div class="col-12 details-table1">
                                In this evaluation, we will analyze the individual's communication skills across various categories to provide a comprehensive assessment of their abilities in expressing ideas, conveying information, and interacting with others. Effective communication is a crucial skill in both personal and professional settings, as it directly impacts relationships, productivity, and overall success.
                            </div>
                        </div>
                        <div class="col-12" style="padding-top: 100px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-lg-5 col-md-6 col-4 mt-10">
                                <div class="col-12 font-Associated">
                                    Associated Questionnaire
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-4">
                                <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Edit Sub Category</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label">Sub-Category Name</label>
                                                        <input type="text" class="form-control" id="recipient-name">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="message-text" class="col-form-label">Sub-Category details</label>
                                                        <textarea class="form-control textarea-font" id="message-text"></textarea>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>




                                <button class="btn btn-outline-secondary" type="button"> <i class="fa fa-plus-circle" aria-hidden="true"></i></button>
                                <button class="btn btn-outline-danger" type="button"> <i class="fa fa-trash" aria-hidden="true"></i></button>
                            </div>
                            <div class="col-lg-3 col-md-6 col-4">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Search" aria-label="" aria-describedby="button-addon2">
                                    <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label check-box" for="flexCheckDefault">
                                    Verbal Communication
                                </label>
                            </div>
                            <div class="row">
                                <div class="col-lg-9 font-Assessing">
                                    Assessing an individual's ability to effectively communicate verbally, including clarity, articulation, tone, and persuasiveness in their spoken interactions.
                                </div>
                                <div class="col-lg-3">
                                    <span class="badge rounded-pill bg-info bg-font-color">7 Use Case</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-10">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label check-box" for="flexCheckDefault">
                                    Written Communication
                                </label>
                            </div>
                            <div class="row">
                                <div class="col-lg-9 font-Assessing">
                                    Evaluating the individual's proficiency in written communication, such as their ability to convey ideas clearly, use appropriate grammar and vocabulary, and structure written documents effectively. </div>
                                <div class="col-lg-3">
                                    <span class="badge rounded-pill bg-info bg-font-color">7 Use Case</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-10">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label check-box" for="flexCheckDefault">
                                    Listening Skills
                                </label>
                            </div>
                            <div class="row">
                                <div class="col-lg-9 font-Assessing">
                                    Assessing how well the individual listens and understands others during conversations or meetings, including their ability to pay attention, ask relevant questions, and demonstrate active listening.
                                </div>
                                <div class="col-lg-3">
                                    <span class="badge rounded-pill bg-info bg-font-color">7 Use Case</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-10">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label check-box" for="flexCheckDefault">
                                    Nonverbal Communication
                                </label>
                            </div>
                            <div class="row">
                                <div class="col-lg-9 font-Assessing">
                                    Evaluating the individual's use of nonverbal cues, such as body language, facial expressions, and gestures, to enhance their communication and convey messages effectively.
                                </div>
                                <div class="col-lg-3">
                                    <span class="badge rounded-pill bg-info bg-font-color">7 Use Case</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-10">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label check-box" for="flexCheckDefault">
                                    Interpersonal Communication
                                </label>
                            </div>
                            <div class="row">
                                <div class="col-lg-9 font-Assessing">
                                    Assessing the individual's ability to build rapport, establish and maintain relationships, and adapt their communication style based on the needs and preferences of others.
                                </div>
                                <div class="col-lg-3">
                                    <span class="badge rounded-pill bg-info bg-font-color">7 Use Case</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-10">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label check-box" for="flexCheckDefault">
                                    Cross-Cultural Communication
                                </label>
                            </div>
                            <div class="row">
                                <div class="col-lg-9 font-Assessing">
                                    Evaluating the individual's effectiveness in communicating and collaborating with individuals from diverse cultural backgrounds, considering their sensitivity to cultural differences and ability to bridge cultural gaps.
                                </div>
                                <div class="col-lg-3">
                                    <span class="badge rounded-pill bg-info bg-font-color">7 Use Case</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-10">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label check-box" for="flexCheckDefault">
                                    Presentation Skills
                                </label>
                            </div>
                            <div class="row">
                                <div class="col-lg-9 font-Assessing">
                                    Assessing the individual's ability to deliver engaging and impactful presentations, including their use of visual aids, confidence, and audience engagement.
                                </div>
                                <div class="col-lg-3">
                                    <span class="badge rounded-pill bg-info bg-font-color">7 Use Case</span>
                                </div>
                            </div>
                        </div>
                    </li>
                    <div class="col-12 text-end" style="padding-top: 50px;">
                        <button type="button" class="btn btn-dark">Back</button>
                        <button type="button" class="btn btn-primary">Save</button>
                    </div>
                </ul>
            </div>
        </div>
    </div>
</div>