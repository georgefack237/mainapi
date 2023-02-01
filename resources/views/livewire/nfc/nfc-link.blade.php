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
                    <span>{{ $profile->email }}
                        <br>{{ $profile->website }}</span>
                </div>
                <a href="mailto:{{ $profile->email }}" class=" ml-auto icon-right">
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
    </div>

    <div class="modal fade" id="saveContact" tabindex="-1" role="dialog" aria-labelledby="saveContactLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="saveContactLabel">Enregistrer contact</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="contact-form" method="POST" action="{{ route('nfc.save') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $profile->id }}">
                        <div class="form-group col-12">
                            <input type="text" class="form-control form-control-muted border-0"
                                style="background: #edf0ff;" placeholder="Nom" name="name">
                                <i class="fas fa-user text-primary position-absolute" style="right: 25px;top:30%;"></i>
                        </div>
                        <div class="form-group col-12">
                            <input type="text" class="form-control form-control-muted border-0"
                                style="background: #edf0ff;" placeholder="Fonction et Entreprise" name="title">
                                <i class="fas fa-user-tie text-primary position-absolute" style="right: 25px;top:30%;"></i>
                        </div>
                        <div class="form-group col-12">
                            <input type="text" class="form-control form-control-muted border-0 position-relative"
                                style="background: #edf0ff;" placeholder="Adresse mail" name="email">
                                <i class="fas fa-envelope text-primary position-absolute" style="right: 25px;top:30%;"></i>
                        </div>
                        <div class="form-group col-12 mb-5">
                            <input type="text" class="form-control form-control-muted border-0 position-relative"
                                style="background: #edf0ff;" placeholder="Téléphone" name="phone">
                                <i class="fas fa-phone text-primary position-absolute" style="right: 25px;top:30%;"></i>
                        </div>
                        <div class="ml-3 mb-5">
                            <span class="mr-3 text-muted">Sex:</span>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="inlineRadio1"
                                    value="Masculin">
                                <label class="form-check-label" for="inlineRadio1">Masculin</label>
                            </div>
                            <div class="form-check form-check-inline ">
                                <input class="form-check-input" type="radio" name="gender" id="inlineRadio2"
                                    value="Feminin">
                                <label class="form-check-label" for="inlineRadio2">Feminin</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <a href="{{ route('nfc.save') }}" class="animated fadeInUp" onclick="submitForm()" data-dismiss="modal">
                        <div class="save px-4">
                            <span class="">Valider</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="bottom-action">
        <a href="#" class="animated fadeInUp" data-toggle="modal" data-target="#saveContact">
            <div class="save px-4">
                <i class="fa fa-arrow-down mr-2"></i><span class="">Enregistrer</span>
            </div>
        </a>
    </div>

    @push('scripts')
        <script>

            function submitForm()
            {
                event.preventDefault();
                document.getElementById('contact-form').submit();
            }
        </script>
    @endpush

</div>
