@extends('layouts.main')
@section('content')
    <!-- ABOUT -->
    <section class="about full-screen d-lg-flex justify-content-center align-items-center" id="home">
        <div class="container">
            <div class="row">

                <div class="col-lg-7 col-md-12 col-12 d-flex align-items-center">
                    <div class="about-text">
                        <small class="small-text">Welcome to <span class="mobile-block">my portfolio
                                website!</span></small>
                        <h1 class="animated animated-text">
                            <span class="mr-2">{{ $homeSection->title }}</span>
                        </h1>

                        <p>{!! $homeSection->short_description !!}</p>

                        <div class="custom-btn-group mt-4">
                            <a href="#about" class="btn mr-lg-2 custom-btn"><i class='uil uil-file-alt'></i> About
                                Me</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 col-md-12 col-12">
                    <div class="about-image svg">
                        <img src="{{ asset('storage/' . $homeSection->hero_image) }}" class="img-fluid" alt="svg image">
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="about full-screen d-lg-flex justify-content-center align-items-center" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-12 col-12">
                    <div class="about-image svg">
                        <img src="{{ asset('storage/' . $aboutSection->about_image) }}" class="img-fluid" alt="svg image">
                    </div>
                </div>
                <div class="col-lg-7 col-md-12 col-12 d-flex align-items-center">
                    <div class="about-text">
                        <h1 class="animated animated-text">
                            <span class="mr-2">About Me</span>
                        </h1>

                        <p>{!! $aboutSection->description !!}</p>

                        <div class="custom-btn-group mt-4">
                            <a href="{{ asset('storage/' . $aboutSection->cv) }}" class="btn mr-lg-2 custom-btn"
                                target="_blank"><i class='uil uil-file-alt'></i> Download
                                Resume</a>
                            <a href="#contact" class="btn custom-btn custom-btn-bg custom-btn-link">Send Message</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- PROJECTS -->
    <section class="project py-5" id="project">
        <div class="container">
            <div class="row">
                <div class="col-lg-11 text-center mx-auto col-12">
                    <div class="col-lg-8 mx-auto">
                        <h2>Project that I have developed</h2>
                    </div>

                    <div class="portfolio mt-5">
                        <div class="row" id="projectContainer">
                            @foreach ($projects->slice(0, 6) as $project)
                                <div class="col-md-4 my-4 project-item">
                                    <div class="item">
                                        <h5>{{ $project->project_name }}</h5>
                                        <div class="project-info">
                                            <img src="{{ asset('storage/' . $project->featured_image) }}" class="img-fluid"
                                                alt="project image"
                                                style="border-radius: 7px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);">

                                            <div class="hover-buttons mt-4">
                                                <a href="javascript:void()" class="btn mr-lg-2 custom-btn"
                                                    data-toggle="modal" data-id="{{ $project->id }}"
                                                    data-target="#dynamicModal">Detail</a>
                                                <a href="{{ $project->url_preview }}" target="_blank"
                                                    class="btn custom-btn custom-btn-bg custom-btn-link">Preview</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade mt-4" id="dynamicModal" data-backdrop="static" data-keyboard="false"
                                    tabindex="-1" aria-labelledby="dynamicModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="dynamicModalLabel">Loading...</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <div class="spinner-border" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="spinner-border my-4 d-none" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>

                    <div class="text-center">
                        <button id="loadMoreBtn" class="btn custom-btn custom-btn-bg custom-btn-link mx-auto">
                            Load More
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SKILLS -->
    <section class="skills py-5 my-5" id="skills">
        <div class="container">
            <div class="row">
                <div class="col-lg-11 text-center mx-auto col-12">
                    <div class="col-lg-8 mx-auto mb-5">
                        <h2>The Programming Language I Use to Develop Web Apps</h2>
                    </div>
                    <div class="row my-4">
                        @foreach ($skills as $skill)
                            <div class="col-md-6 my-2">
                                <div class="card d-flex align-items-center p-3"
                                    style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                                    <div class="row g-0 w-100">
                                        <div class="col-4 icon-skills text-center my-auto">
                                            <img src="{{ asset('storage/' . $skill->skill_logo) }}"
                                                alt="{{ $skill->skill_name }}" width="100px" height="100px"
                                                class="img-fluid">
                                        </div>
                                        <div class="col-8">
                                            <div class="card-body">
                                                <h4>{{ $skill->skill_name }}</h4>
                                                <p>{!! $skill->skill_description !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Tools Programming -->
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 mx-auto my-5">
                                <h2>Assisted by several tools</h2>
                            </div>
                        </div>
                        <div class="swiper mySwiper">
                            <div class="swiper-wrapper">
                                @foreach ($tools as $tool)
                                    <div class="swiper-slide">
                                        <img src="{{ asset('storage/' . $tool->tool_logo) }}"
                                            alt="{{ $tool->tool_name }}" width="100" height="100"
                                            class="d-block mx-auto img-icon icon-slide">
                                        <h4 class="text-center">{{ $tool->tool_name }}</h4>
                                    </div>
                                @endforeach

                            </div>
                            <!-- Tombol Navigasi -->
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                            <!-- Pagination -->
                            <div class="swiper-pagination mt-5"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- CONTACT -->
    <section class="contact py-5 mt-5" id="contact">
        <div class="container">
            <div class="row">

                <div class="col-lg-5 mr-lg-5 col-12">
                    <div class="about-image svg">
                        <img src="/assets/images/undraw_online-test_20lm.svg" class="img-fluid" alt="svg image">
                    </div>
                </div>

                <div class="col-lg-6 col-12">
                    <div class="contact-form">
                        <h2 class="mb-4">Interested to work together? Let's talk</h2>

                        <form id="contact-form">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Your Name"
                                        id="name" required>
                                    <div class="text-danger d-none" id="name_error"></div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Email"
                                        id="email" required>
                                    <div class="text-danger d-none" id="email_error"></div>
                                </div>
                                <div class="col-12">
                                    <label for="message">Message</label>
                                    <textarea name="message" rows="6" class="form-control" id="message" placeholder="Message" required></textarea>
                                    <div class="text-danger d-none" id="message_error"></div>
                                </div>
                                <div class="ml-lg-auto col-lg-5 col-12">
                                    <input type="button" class="form-control submit-btn" id="send"
                                        value="Send Button">
                                </div>
                            </div>
                        </form>


                    </div>
                </div>

            </div>
        </div>
    </section>

    <script>
        $(document).on('click', '[data-target="#dynamicModal"]', function() {
            let projectId = $(this).data('id');
            let modal = $('#dynamicModal');

            // Reset modal content
            modal.find('.modal-title').text('Loading...');
            modal.find('.modal-body').html(`
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            `);

            // Fetch project details
            $.ajax({
                url: '/projects/' + projectId,
                method: 'GET',
                success: function(data) {
                    modal.find('.modal-title').text(data.project_name);
                    modal.find('.modal-body').html(`
                        <div class="container-fluid detail-project">
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <img src="/storage/${data.featured_image}" class="img-fluid rounded shadow-sm mb-3" 
                                        alt="${data.project_name}">
                                </div>
                               <div class="col-md-8">
                                        <div class="modal-body" style="text-align: justify;">
                             <h5 style="text-align: justify;">${data.project_name}</h5>
    <p>${data.project_description}</p>
</div>
                            </div>
                        </div>
                    `);
                },
                error: function() {
                    modal.find('.modal-title').text('Error');
                    modal.find('.modal-body').html('<p>Could not load project details.</p>');
                }
            });
        });


        // Load more projects
        document.addEventListener('DOMContentLoaded', function() {
            const allProjects = @json($projects);
            let displayedCount = 6;

            document.getElementById('loadMoreBtn').addEventListener('click', function() {
                const projectContainer = document.getElementById('projectContainer');
                const remainingItems = allProjects.length - displayedCount;
                const itemsToLoad = Math.min(remainingItems, 6);

                if (projectContainer && remainingItems > 0) {
                    for (let i = displayedCount; i < displayedCount + itemsToLoad; i++) {
                        const project = allProjects[i];
                        const projectItem = document.createElement('div');
                        projectItem.className = 'col-md-4 my-4 project-item';
                        projectItem.innerHTML = `
                        <div class="item">
                            <h5>${project.project_name}</h5>
                            <div class="project-info">
                                <img src="/storage/${project.featured_image}" class="img-fluid"
                                    alt="project image"
                                    style="border-radius: 7px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);">

                                <div class="hover-buttons mt-4">
                                    <a href="javascript:void()" class="btn mr-lg-2 custom-btn"
                                        data-toggle="modal" data-id="${project.id}"
                                        data-target="#dynamicModal">Detail</a>
                                    <a href="${project.url_preview}" target="_blank"
                                        class="btn custom-btn custom-btn-bg custom-btn-link">Preview</a>
                                </div>
                            </div>
                        </div>
                    `;
                        projectContainer.appendChild(projectItem);
                    }
                    displayedCount += itemsToLoad;
                }

                if (displayedCount >= allProjects.length) {
                    this.style.display = 'none';
                }
            });
        });


        // Proccess Send Email
        $('#send').click(function(e) {
            e.preventDefault();

            let name = $('#name').val();
            let email = $('#email').val();
            let message = $('#message').val();
            let token = $("input[name='_token']").val();

            $.ajax({
                url: '/send-email',
                type: 'POST',
                data: {
                    _token: token,
                    name: name,
                    email: email,
                    message: message,
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: true,
                        timer: 3000,
                    });

                    $('#name').val('');
                    $('#email').val('');
                    $('#message').val('');
                },
                error: function(error) {
                    let errorMessage = '';

                    if (error.responseJSON.name) {
                        errorMessage += `<p>${error.responseJSON.name[0]}</p>`;
                    }
                    if (error.responseJSON.email) {
                        errorMessage += `<p>${error.responseJSON.email[0]}</p>`;
                    }
                    if (error.responseJSON.message) {
                        errorMessage += `<p>${error.responseJSON.message[0]}</p>`;
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Errors',
                        html: errorMessage,
                        timer: 5000,
                        showConfirmButton: true,
                    });
                }
            });
        });
    </script>
@endsection
