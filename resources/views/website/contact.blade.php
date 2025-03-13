<x-layout title="Contact US">
    <!-- Page Header-->
    <header class="masthead" style="background-image: url('{{ asset('website/assets/img/contact-bg.jpg') }}')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="page-heading">
                        <h1>Contact Me</h1>
                        <span class="subheading">Have questions? I have answers.</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main Content-->
    <main class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <p>Want to get in touch? Fill out the form below to send me a message and I will get back to you as soon as possible!</p>
                    <div class="my-5">
                        <form method="post" action="{{ route('website.contact') }}">
                            @csrf
                            <div class="form-floating">
                                <input class="form-control @error('name') is-invalid
                                @enderror" name="name" id="name" type="text" placeholder="Enter your name..." />
                                <label for="name">Name</label>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-floating">
                                <input class="form-control @error('email') is-invalid
                                @enderror" name="email" id="email" type="email" placeholder="Enter your email..." />
                                <label for="email">Email address</label>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-floating">
                                <input class="form-control @error('phone') is-invalid
                                @enderror" name="phone" id="phone" type="tel" placeholder="Enter your phone number..."/>
                                <label for="phone">Phone Number</label>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-floating">
                                <textarea class="form-control @error('message') is-invalid
                                @enderror" name="message" id="message" placeholder="Enter your message here..." style="height: 12rem"></textarea>
                                <label for="message">Message</label>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <br />
                            <!-- Submit Button-->
                            <button class="btn btn-primary text-uppercase" type="submit">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>

