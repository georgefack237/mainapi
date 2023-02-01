<div>
    <div class="name-card">
        <div class="profile-icon mb-4 animated fadeInDown">
            <div class="circle">
                <img src="{{ asset('storage/img/nfc/profile/' . $profile->image) }}" alt="">
            </div>
        </div>
        <div class="name text-center animated fadeInUp">
            <h3 class="text-uppercase">{{ $profile->firstname }}</h3>
            <h5 class="text-uppercase text-muted">{{ $profile->lastname }}</h5>
        </div>
        <div class="divider my-1 animated fadeInUp"></div>
        <p class="text-muted text-center animated fadeInUp">{{ $profile->title }}</p>
    </div>

    <div class="container pb-5">

        <div class="contact-block mt-2 animated fadeInUp">
            <div class="single">
                <div class="corner">
                    <i class="fas fa-map-marker-alt icon-left"></i>
                </div>
                <div class="ml-2">
                    <span>{{ $profile->address }}</span>
                </div>
                <!-- <i class="fas fa-map-marker-alt ml-auto"></i> -->
            </div>
            <div class="single with-icon-right mt-2">
                <div class="corner">
                    <i class="fas fa-mobile-alt icon-left"></i>
                </div>
                <div class="ml-2">
                    <span>{{ $profile->phone1 }}
                        <br>{{ $profile->phone1 }}</span>
                </div>
                <a href="tel:{{ $profile->phone1 }}" class=" ml-auto icon-right">
                    <i class="fas fa-phone"></i>
                </a>
            </div>
            <div class="single with-icon-right mt-2">
                <div class="corner">
                    <a href="http://{{ $profile->website }}"><i class="fas fa-globe icon-left"></i></a>
                </div>
                <div class="ml-2">
                    <span>{{ $profile->mail1 }}
                        <br>{{ $profile->website }}</span>
                </div>
                <a href="mailto:{{ $profile->mail1 }}" class=" ml-auto icon-right">
                    <i class="fa fa-paper-plane"></i>
                </a>
            </div>
            <div class="socials-block mt-2 py-3 px-3">
                <h4 class="text-center">Réseaux sociaux</h4>
                <div class="d-flex justify-content-center">
                    <a href="{{ $profile->facebook }}" class="btn rounded-circle btn-primary bg-facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="{{ $profile->linkedin }}" class="btn rounded-circle btn-info bg-in">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="{{ $profile->twitter }}" class="btn rounded-circle btn-primary bg-twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                </div>
            </div>
            {{-- <div class="scroll"></div> --}}
        </div>
        <form id="contact-form" method="POST" action="{{ route('nfc.save') }}">
            @csrf
            <input type="hidden" name="id" value="{{ $profile->id }}">
            <div class="form-group col-md-6">
                <input type="text" class="form-control form-control-muted border-0" style="background: #e6f3f0;" placeholder="Nom" name="name">
            </div>
            <div class="form-group col-md-6">
                <input type="text" class="form-control form-control-muted border-0" style="background: #e6f3f0;" placeholder="Fonction et Entreprise"
                    name="title">
            </div>
            <div class="form-group col-md-6 mb-5">
                <input type="text" class="form-control form-control-muted border-0" style="background: #e6f3f0;" placeholder="Téléphone" name="phone">
            </div>
        </form>
    </div>

    <div class="bottom-action">
        <a href="#" onclick="showBtn()" id="first-action" class="animated fadeInUp">
            <div class="save px-4">
                <i class="fa fa-arrow-down mr-2"></i><span class="">Enregistrer</span>
            </div>
        </a>
        <a href="{{ route('nfc.save') }}" id="second-action" onclick="submitForm()" class="animated fadeInUp">
            <div class="save px-4">
                <i class="fa fa-arrow-down mr-2"></i><span class="">Enregistrer</span>
            </div>
        </a>
        {{-- <a href="{{ route('nfc.save', $profile->id) }}" class="animated fadeInUp">
            <div class="save px-4">
                <i class="fa fa-arrow-down mr-2"></i><span class="">Enregistrer</span>
            </div>
        </a> --}}
    </div>

    @push('scripts')
        <script>
            console.log('hello hello')
            document.getElementById("contact-form").style.display = "none";
            document.getElementById("second-action").style.display = "none";

            function showBtn() {
                event.preventDefault();
                document.getElementById("contact-form").style.display = "block";
                document.getElementById("first-action").style.display = "none";
                document.getElementById("second-action").style.display = "block";
            }

            function submitForm()
            {
                event.preventDefault();
                document.getElementById('contact-form').submit();
                document.getElementById("contact-form").style.display = "none";
                document.getElementById("second-action").style.display = "none";
                document.getElementById("first-action").style.display = "block";
            }
        </script>
    @endpush
</div>
