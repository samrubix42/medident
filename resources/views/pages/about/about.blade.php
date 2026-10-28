<div>
    {{-- HERO SECTION --}}
    <section class="relative overflow-hidden bg-[#FAFDFE] py-10 sm:py-16 lg:py-20">
        <div class="relative mx-auto grid max-w-7xl items-center gap-10 px-5 sm:px-6 lg:grid-cols-2 lg:gap-14 lg:px-8">
            <div>
                <nav class="flex items-center gap-2 text-xs font-medium text-slate-400" aria-label="Breadcrumb">
                    <a href="{{ route('home') }}" class="transition hover:text-med-blue">Home</a>
                    <i class="ri-arrow-right-s-line text-sm text-slate-300"></i>
                    <span class="text-med-blue">About Us</span>
                </nav>

                <h1 class="mt-5 text-3xl font-extrabold leading-[1.16] tracking-tight text-med-navy sm:text-5xl lg:text-[3.5rem]">
                    Medical, diabetes and
                    <span class="text-med-blue">dental care</span> <br class="hidden sm:inline">
                    under one roof<span class="text-med-blue">.</span>
                </h1>

                <p class="mt-5 max-w-xl text-base leading-relaxed text-slate-600 sm:text-lg sm:leading-8">
                    MediDENT Multicare Clinic is a trusted destination for advanced general medicine, specialized diabetes management, and comprehensive family dental care in Shastri Nagar, Ghaziabad.
                </p>

                <div class="mt-8 flex flex-col gap-3.5 sm:flex-row sm:items-center">
                    <button type="button"
                       @click="$dispatch('open-booking-modal')"
                       class="group inline-flex w-full sm:w-auto items-center justify-center gap-2.5 rounded-full bg-med-navy px-7 py-3.5 text-sm font-semibold text-white shadow-md transition-all duration-200 hover:bg-med-blue hover:shadow-lg active:translate-y-0">
                        <span>Book an Appointment</span>
                        <i class="ri-arrow-right-line text-base transition-transform duration-200 group-hover:translate-x-1"></i>
                    </button>

                    <a href="#doctors"
                       class="group inline-flex w-full sm:w-auto items-center justify-center gap-2 rounded-full border border-slate-200 bg-white px-7 py-3.5 text-sm font-semibold text-med-navy shadow-sm transition-all duration-200 hover:border-med-blue hover:text-med-blue hover:shadow-md active:translate-y-0">
                        <i class="ri-team-line text-med-blue text-base"></i>
                        <span>Meet Our Doctors</span>
                    </a>
                </div>

                {{-- Specialties Pills --}}
                <div class="mt-8 sm:mt-10 grid grid-cols-1 sm:grid-cols-3 gap-3 border-t border-slate-100 pt-6">
                    <div class="flex items-center gap-3 rounded-2xl border border-slate-100 bg-white p-3.5 shadow-sm">
                        <span class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-sky-50 text-xl text-med-blue">
                            <i class="ri-stethoscope-line"></i>
                        </span>
                        <div>
                            <p class="text-xs font-bold text-med-navy">General Medicine</p>
                            <p class="text-[11px] text-slate-400">Complete health</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 rounded-2xl border border-slate-100 bg-white p-3.5 shadow-sm">
                        <span class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-red-50 text-xl text-med-red">
                            <i class="ri-heart-pulse-line"></i>
                        </span>
                        <div>
                            <p class="text-xs font-bold text-med-navy">Diabetes Care</p>
                            <p class="text-[11px] text-slate-400">Expert control</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 rounded-2xl border border-slate-100 bg-white p-3.5 shadow-sm">
                        <span class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-cyan-50 text-xl text-cyan-700">
                            <i class="ri-tooth-line"></i>
                        </span>
                        <div>
                            <p class="text-xs font-bold text-med-navy">Dental Care</p>
                            <p class="text-[11px] text-slate-400">Healthy smiles</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right: Hero Image with Floating Info Card --}}
            <div class="relative">
                <div class="relative overflow-hidden rounded-[2rem] sm:rounded-[2.5rem] bg-slate-100 shadow-[0_20px_50px_rgba(18,50,74,0.12)]">
                    <img
                        src="{{ asset('images/hero-img.jpg') }}"
                        alt="MediDENT Multicare Clinic care team"
                        fetchpriority="high"
                        class="h-[340px] w-full object-cover sm:h-[440px] lg:h-[480px]"
                    >

                    <div class="pointer-events-none absolute inset-x-0 bottom-0 h-32 bg-gradient-to-t from-med-navy/50 via-med-navy/15 to-transparent"></div>

                    <div class="absolute bottom-5 left-5 right-5 sm:bottom-6 sm:left-6 sm:right-auto sm:max-w-xs rounded-2xl border border-white/60 bg-white/95 p-4 shadow-lg backdrop-blur-md">
                        <div class="flex items-center gap-3">
                            <span class="grid h-11 w-11 shrink-0 place-items-center rounded-xl bg-sky-50 text-xl text-med-blue">
                                <i class="ri-user-heart-line"></i>
                            </span>
                            <div>
                                <p class="text-sm font-bold text-med-navy">Patient-First Care</p>
                                <p class="mt-0.5 text-xs leading-relaxed text-slate-500">Dedicated to listening, explaining, and caring at every visit.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- STATS SECTION --}}
    <section class="border-y border-slate-100 bg-white py-10 sm:py-12">
        <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-4 sm:gap-6 rounded-3xl bg-med-navy p-6 sm:p-10 text-white shadow-xl lg:grid-cols-4">
                <div class="text-center">
                    <p class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">5,000+</p>
                    <p class="mt-2 text-xs font-semibold uppercase tracking-[0.14em] text-cyan-300">Treated Patients</p>
                </div>

                <div class="text-center">
                    <p class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">15+</p>
                    <p class="mt-2 text-xs font-semibold uppercase tracking-[0.14em] text-cyan-300">Medical Staff</p>
                </div>

                <div class="text-center">
                    <p class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">3</p>
                    <p class="mt-2 text-xs font-semibold uppercase tracking-[0.14em] text-cyan-300">Care Specialties</p>
                </div>

                <div class="text-center">
                    <p class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">6</p>
                    <p class="mt-2 text-xs font-semibold uppercase tracking-[0.14em] text-cyan-300">Days a Week</p>
                </div>
            </div>
        </div>
    </section>

    {{-- OUR STORY --}}
    <section class="bg-white py-12 sm:py-16 lg:py-24">
        <div class="mx-auto grid max-w-7xl items-center gap-10 px-5 sm:px-6 lg:grid-cols-2 lg:gap-16 lg:px-8">
            <div class="relative">
                <div class="relative overflow-hidden rounded-3xl border-[6px] border-white bg-slate-100 shadow-[0_25px_60px_rgba(18,50,74,0.12)]">
                    <img
                        src="{{ asset('images/general-diseases.jpg') }}"
                        alt="Doctor consulting a patient at MediDENT"
                        loading="lazy"
                        decoding="async"
                        class="h-[340px] w-full object-cover sm:h-[440px]"
                    >

                    <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-med-navy/50 to-transparent p-6">
                        <p class="text-sm font-medium text-white">Quality healthcare tailored to individual lives</p>
                    </div>
                </div>

                <div class="absolute -bottom-6 -right-3 hidden w-64 rounded-2xl border border-slate-100 bg-white p-5 shadow-[0_18px_45px_rgba(18,50,74,0.12)] sm:block lg:-right-6">
                    <i class="ri-double-quotes-l text-3xl text-med-blue"></i>
                    <p class="mt-2 text-sm font-semibold leading-relaxed text-med-navy">
                        High-quality, compassionate care for optimal health and lifelong wellbeing.
                    </p>
                </div>
            </div>

            <div>
                <h2 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold leading-tight tracking-tight text-med-navy">
                    Comprehensive care, delivered with compassion<span class="text-med-blue">.</span>
                </h2>

                <p class="mt-5 text-base leading-relaxed text-slate-600">
                    MediDENT Multicare Clinic brings medical, diabetic and dental services together in one convenient place in Shastri Nagar, Ghaziabad. Our team is dedicated to providing high-quality, compassionate care and helping you achieve optimal wellbeing.
                </p>

                <p class="mt-3 text-sm leading-relaxed text-slate-500 sm:text-base">
                    Whether you are visiting for a routine check-up, ongoing diabetes support, or specialist dental treatment, we take the time to understand your needs and build a care plan that fits your life.
                </p>

                <div class="mt-8 grid gap-4 sm:grid-cols-2">
                    <div class="group flex gap-3.5 rounded-2xl border border-slate-100 bg-[#fbfdfd] p-4.5 transition hover:bg-white hover:shadow-sm">
                        <span class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-sky-50 text-xl text-med-blue">
                            <i class="ri-team-line"></i>
                        </span>
                        <div>
                            <h3 class="text-sm font-bold text-med-navy">Experienced Doctors</h3>
                            <p class="mt-1 text-xs leading-relaxed text-slate-500">Qualified physicians, diabetologists, and dental surgeons.</p>
                        </div>
                    </div>

                    <div class="group flex gap-3.5 rounded-2xl border border-slate-100 bg-[#fbfdfd] p-4.5 transition hover:bg-white hover:shadow-sm">
                        <span class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-cyan-50 text-xl text-cyan-700">
                            <i class="ri-hospital-line"></i>
                        </span>
                        <div>
                            <h3 class="text-sm font-bold text-med-navy">Integrated Clinic</h3>
                            <p class="mt-1 text-xs leading-relaxed text-slate-500">Medical, diabetes, and dental under a single roof.</p>
                        </div>
                    </div>

                    <div class="group flex gap-3.5 rounded-2xl border border-slate-100 bg-[#fbfdfd] p-4.5 transition hover:bg-white hover:shadow-sm">
                        <span class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-red-50 text-xl text-med-red">
                            <i class="ri-heart-2-line"></i>
                        </span>
                        <div>
                            <h3 class="text-sm font-bold text-med-navy">Personal Attention</h3>
                            <p class="mt-1 text-xs leading-relaxed text-slate-500">Care plans tailored to your specific health goals.</p>
                        </div>
                    </div>

                    <div class="group flex gap-3.5 rounded-2xl border border-slate-100 bg-[#fbfdfd] p-4.5 transition hover:bg-white hover:shadow-sm">
                        <span class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-emerald-50 text-xl text-emerald-600">
                            <i class="ri-chat-check-line"></i>
                        </span>
                        <div>
                            <h3 class="text-sm font-bold text-med-navy">Clear Guidance</h3>
                            <p class="mt-1 text-xs leading-relaxed text-slate-500">Understand your options and steps to lasting recovery.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- WHAT WE DO (THREE SPECIALTIES) --}}
    <section id="care" class="border-y border-slate-100 bg-[#FAFDFE] py-12 sm:py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
                <div class="max-w-2xl">
                    <h2 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-med-navy">
                        Three specialties<span class="text-med-blue">.</span> One connected care experience<span class="text-med-blue">.</span>
                    </h2>

                    <p class="mt-3 sm:mt-4 max-w-xl text-sm sm:text-base leading-relaxed text-slate-600">
                        From everyday healthcare to long-term condition management and complete dental care, our services are designed around you.
                    </p>
                </div>

                <button type="button"
                    @click="$dispatch('open-booking-modal')"
                    class="group inline-flex w-full sm:w-auto shrink-0 items-center justify-center gap-2.5 rounded-full bg-med-navy px-7 py-3.5 text-sm font-semibold text-white shadow-md transition-all duration-200 hover:-translate-y-0.5 hover:bg-med-blue hover:shadow-lg">
                    <span>Book a Consultation</span>
                    <i class="ri-arrow-right-line transition-transform duration-200 group-hover:translate-x-1"></i>
                </button>
            </div>

            <div class="mt-10 grid gap-6 sm:mt-12 sm:grid-cols-2 lg:grid-cols-3 sm:[&>*:last-child]:col-span-2 lg:[&>*:last-child]:col-span-1">
                {{-- Medical Care --}}
                <article class="group relative flex flex-col justify-between overflow-hidden rounded-3xl border border-slate-100 bg-white p-7 shadow-sm transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_25px_60px_rgba(18,50,74,0.12)] sm:p-8">
                    <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-sky-50/50 transition duration-500 group-hover:scale-150"></div>
                    
                    <div class="relative">
                        <div class="flex items-center justify-between">
                            <div class="grid h-16 w-16 place-items-center rounded-2xl bg-gradient-to-br from-sky-50 to-sky-100/50 text-2xl text-med-blue transition duration-300 group-hover:scale-110">
                                <i class="ri-stethoscope-line"></i>
                            </div>

                            <span class="text-xs font-mono font-bold tracking-widest text-slate-300 uppercase">
                                01 / MED
                            </span>
                        </div>

                        <h3 class="mt-8 text-2xl font-bold text-med-navy group-hover:text-med-blue transition-colors">
                            Medical Care
                        </h3>

                        <p class="mt-3 text-sm leading-relaxed text-slate-600">
                            General health check-ups, diagnosis and treatment for viral illnesses, cough, fever, hypertension, asthma, and preventive wellness checkups.
                        </p>
                    </div>

                    <button type="button"
                       @click="$dispatch('open-booking-modal')"
                       class="group/btn mt-8 inline-flex items-center gap-2 border-t border-slate-100 pt-4 text-sm font-semibold text-med-blue">
                        <span>Book a Consultation</span>
                        <i class="ri-arrow-right-line transition-transform duration-200 group-hover/btn:translate-x-1"></i>
                    </button>
                </article>

                {{-- Diabetic Care --}}
                <article class="group relative flex flex-col justify-between overflow-hidden rounded-3xl border border-slate-100 bg-white p-7 shadow-sm transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_25px_60px_rgba(18,50,74,0.12)] sm:p-8">
                    <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-red-50/50 transition duration-500 group-hover:scale-150"></div>
                    
                    <div class="relative">
                        <div class="flex items-center justify-between">
                            <div class="grid h-16 w-16 place-items-center rounded-2xl bg-gradient-to-br from-red-50 to-red-100/50 text-2xl text-med-red transition duration-300 group-hover:scale-110">
                                <i class="ri-heart-pulse-line"></i>
                            </div>

                            <span class="text-xs font-mono font-bold tracking-widest text-slate-300 uppercase">
                                02 / DIAB
                            </span>
                        </div>

                        <h3 class="mt-8 text-2xl font-bold text-med-navy group-hover:text-med-red transition-colors">
                            Diabetic Care
                        </h3>

                        <p class="mt-3 text-sm leading-relaxed text-slate-600">
                            Regular blood sugar monitoring, HbA1c review, dietary counseling, medication management, and proactive care to prevent long-term diabetic complications.
                        </p>
                    </div>

                    <button type="button"
                       @click="$dispatch('open-booking-modal')"
                       class="group/btn mt-8 inline-flex items-center gap-2 border-t border-slate-100 pt-4 text-sm font-semibold text-med-red">
                        <span>Plan Your Care</span>
                        <i class="ri-arrow-right-line transition-transform duration-200 group-hover/btn:translate-x-1"></i>
                    </button>
                </article>

                {{-- Dental Care --}}
                <article class="group relative flex flex-col justify-between overflow-hidden rounded-3xl border border-slate-100 bg-white p-7 shadow-sm transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_25px_60px_rgba(18,50,74,0.12)] sm:p-8">
                    <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-cyan-50/50 transition duration-500 group-hover:scale-150"></div>
                    
                    <div class="relative">
                        <div class="flex items-center justify-between">
                            <div class="grid h-16 w-16 place-items-center rounded-2xl bg-gradient-to-br from-cyan-50 to-cyan-100/50 text-2xl text-cyan-700 transition duration-300 group-hover:scale-110">
                                <i class="ri-tooth-line"></i>
                            </div>

                            <span class="text-xs font-mono font-bold tracking-widest text-slate-300 uppercase">
                                03 / DENT
                            </span>
                        </div>

                        <h3 class="mt-8 text-2xl font-bold text-med-navy group-hover:text-cyan-700 transition-colors">
                            Dental Care
                        </h3>

                        <p class="mt-3 text-sm leading-relaxed text-slate-600">
                            Painless root canal treatment, cleanings, tooth fillings, cosmetic dentistry, crowns, and pediatric oral care for the whole family.
                        </p>
                    </div>

                    <button type="button"
                       @click="$dispatch('open-booking-modal')"
                       class="group/btn mt-8 inline-flex items-center gap-2 border-t border-slate-100 pt-4 text-sm font-semibold text-cyan-700">
                        <span>Book a Dental Visit</span>
                        <i class="ri-arrow-right-line transition-transform duration-200 group-hover/btn:translate-x-1"></i>
                    </button>
                </article>
            </div>
        </div>
    </section>

    {{-- OUR EXPERT DOCTORS --}}
    <section id="doctors" class="scroll-mt-24 bg-white py-12 sm:py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
                <div class="max-w-2xl">
                    <h2 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-med-navy">
                        Our Expert Doctors<span class="text-med-blue">.</span>
                    </h2>

                    <p class="mt-3 sm:mt-4 max-w-xl text-sm sm:text-base leading-relaxed text-slate-600">
                        Experienced professionals dedicated to providing attentive, personalized care for you and your family in Ghaziabad.
                    </p>
                </div>

                <button type="button"
                    @click="$dispatch('open-booking-modal')"
                    class="group inline-flex w-full sm:w-auto shrink-0 items-center justify-center gap-2.5 rounded-full bg-med-navy px-7 py-3.5 text-sm font-semibold text-white shadow-md transition-all duration-200 hover:-translate-y-0.5 hover:bg-med-blue hover:shadow-lg">
                    <span>Book an Appointment</span>
                    <i class="ri-arrow-right-line transition-transform duration-200 group-hover:translate-x-1"></i>
                </button>
            </div>

            <div class="mt-10 space-y-8 sm:mt-12">
                {{-- Dr. Divya Prakash --}}
                <article class="group overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-sm transition-all duration-300 hover:shadow-[0_25px_60px_rgba(18,50,74,0.12)]">
                    <div class="grid lg:grid-cols-[.42fr_.58fr]">
                        <div class="relative min-h-[340px] overflow-hidden bg-slate-100 lg:min-h-full">
                            <img
                                src="{{ asset('doctors/Dr.-Divya-Prakash.jpeg') }}"
                                alt="Dr. Divya Prakash"
                                loading="lazy"
                                decoding="async"
                                class="h-full w-full object-cover object-top transition duration-700 group-hover:scale-105"
                            >

                            <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-med-navy/50 via-transparent to-transparent"></div>
                        </div>

                        <div class="p-6 sm:p-8 lg:p-10">
                            <p class="text-xs font-bold uppercase tracking-[0.2em] text-med-red">
                                Internal Medicine &amp; Diabetes
                            </p>

                            <h3 class="mt-2 text-2xl font-extrabold tracking-tight text-med-navy sm:text-3xl">
                                <a href="{{ route('physician') }}" class="transition hover:text-med-blue">
                                    Dr. Divya Prakash
                                </a>
                            </h3>

                            <p class="mt-1.5 text-sm font-bold text-med-blue">
                                Consultant Physician &amp; Diabetologist
                            </p>

                            <p class="mt-1 text-xs font-medium tracking-wide text-slate-400">
                                M.B.B.S., DNB, MNAMS, CCEBDM (Diabetology) · 10+ Years Experience
                            </p>

                            <p class="mt-4 text-sm leading-relaxed text-slate-600">
                                Dr. Divya Prakash has over 10 years of clinical experience as a Diabetologist and General Physician. He is one of the most trusted physicians in Delhi NCR at MediDENT Multicare Clinic, Shastri Nagar, Ghaziabad.
                            </p>

                            <div class="mt-6 grid gap-3.5 border-t border-slate-100 pt-5 sm:grid-cols-2">
                                <div class="flex items-start gap-3 rounded-2xl border border-slate-100 bg-[#fbfdfd] p-3.5">
                                    <span class="grid h-9 w-9 shrink-0 place-items-center rounded-xl bg-sky-50 text-med-blue">
                                        <i class="ri-time-line text-lg"></i>
                                    </span>
                                    <div>
                                        <p class="text-xs font-bold text-med-navy">MediDENT Timings</p>
                                        <p class="mt-0.5 text-xs leading-5 text-slate-600">Mon–Sat: 11 AM–12 PM &amp; 5:30 PM–8:30 PM</p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-3 rounded-2xl border border-slate-100 bg-[#fbfdfd] p-3.5">
                                    <span class="grid h-9 w-9 shrink-0 place-items-center rounded-xl bg-sky-50 text-med-blue">
                                        <i class="ri-map-pin-line text-lg"></i>
                                    </span>
                                    <div>
                                        <p class="text-xs font-bold text-med-navy">Yashoda Clinics</p>
                                        <p class="mt-0.5 text-xs leading-5 text-slate-600">Raj Nagar Extension · 12 PM–2 PM, 7 days</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 flex flex-col sm:flex-row flex-wrap items-stretch sm:items-center gap-2.5 sm:gap-3">
                                <a href="tel:+918800023032"
                                   class="inline-flex items-center justify-center gap-2 rounded-full bg-med-navy px-5 py-2.5 text-xs font-semibold text-white shadow-sm transition hover:bg-med-blue hover:shadow-md">
                                    <i class="ri-phone-line"></i>
                                    <span>+91-8800023032</span>
                                </a>

                                <a href="tel:+911204169996"
                                   class="inline-flex items-center justify-center gap-2 rounded-full border border-slate-200 bg-white px-5 py-2.5 text-xs font-semibold text-med-navy shadow-sm transition hover:border-med-blue hover:text-med-blue">
                                    <i class="ri-phone-line"></i>
                                    <span>0120-4169996</span>
                                </a>

                                <a href="{{ route('physician') }}"
                                   class="inline-flex items-center justify-center gap-2 rounded-full border border-slate-200 bg-white px-5 py-2.5 text-xs font-semibold text-med-navy shadow-sm transition hover:border-med-blue hover:text-med-blue">
                                    <span>View Profile</span>
                                    <i class="ri-arrow-right-line"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </article>

                {{-- Dr. Ratika Gupta --}}
                <article class="group overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-sm transition-all duration-300 hover:shadow-[0_25px_60px_rgba(18,50,74,0.12)]">
                    <div class="grid lg:grid-cols-[.42fr_.58fr]">
                        <div class="relative min-h-[340px] overflow-hidden bg-slate-100 lg:order-last lg:min-h-full">
                            <img
                                src="{{ asset('doctors/Dr.-RatikaGupta.jpg') }}"
                                alt="Dr. Ratika Gupta"
                                loading="lazy"
                                decoding="async"
                                class="h-full w-full object-cover object-top transition duration-700 group-hover:scale-105"
                            >

                            <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-med-navy/50 via-transparent to-transparent"></div>
                        </div>

                        <div class="p-6 sm:p-8 lg:p-10">
                            <p class="text-xs font-bold uppercase tracking-[0.2em] text-cyan-700">
                                Dental Care &amp; Pediatric Dentistry
                            </p>

                            <h3 class="mt-2 text-2xl font-extrabold tracking-tight text-med-navy sm:text-3xl">
                                <a href="{{ route('dentist') }}" class="transition hover:text-cyan-700">
                                    Dr. Ratika Gupta
                                </a>
                            </h3>

                            <p class="mt-1.5 text-sm font-bold text-cyan-700">
                                Best Dentist &amp; Dental Surgeon
                            </p>

                            <p class="mt-1 text-xs font-medium tracking-wide text-slate-400">
                                B.D.S., M.D.S. · 12+ Years Experience
                            </p>

                            <p class="mt-4 text-sm leading-relaxed text-slate-600">
                                Dr. Ratika Gupta has over 12 years of experience as a Dental Surgeon in Ghaziabad and Delhi NCR. She specializes in Pediatric and Preventive Dentistry, General Dentistry, Cosmetic Smile Styling, and Dental Implants.
                            </p>

                            <div class="mt-6 grid gap-3.5 border-t border-slate-100 pt-5 sm:grid-cols-2">
                                <div class="flex items-start gap-3 rounded-2xl border border-slate-100 bg-[#fbfdfd] p-3.5">
                                    <span class="grid h-9 w-9 shrink-0 place-items-center rounded-xl bg-cyan-50 text-cyan-700">
                                        <i class="ri-time-line text-lg"></i>
                                    </span>
                                    <div>
                                        <p class="text-xs font-bold text-med-navy">Clinic Timings</p>
                                        <p class="mt-0.5 text-xs leading-5 text-slate-600">Mon–Sat: 11 AM–1 PM &amp; 5 PM–8 PM</p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-3 rounded-2xl border border-slate-100 bg-[#fbfdfd] p-3.5">
                                    <span class="grid h-9 w-9 shrink-0 place-items-center rounded-xl bg-cyan-50 text-cyan-700">
                                        <i class="ri-tooth-line text-lg"></i>
                                    </span>
                                    <div>
                                        <p class="text-xs font-bold text-med-navy">Specialties</p>
                                        <p class="mt-0.5 text-xs leading-5 text-slate-600">Pediatric, cosmetic &amp; implant dentistry</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 flex flex-col sm:flex-row flex-wrap items-stretch sm:items-center gap-2.5 sm:gap-3">
                                <a href="tel:+918290582582"
                                   class="inline-flex items-center justify-center gap-2 rounded-full bg-cyan-700 px-5 py-2.5 text-xs font-semibold text-white shadow-sm transition hover:bg-cyan-800 hover:shadow-md">
                                    <i class="ri-phone-line"></i>
                                    <span>+91-8290582582</span>
                                </a>

                                <a href="{{ route('dentist') }}"
                                   class="inline-flex items-center justify-center gap-2 rounded-full border border-slate-200 bg-white px-5 py-2.5 text-xs font-semibold text-med-navy shadow-sm transition hover:border-cyan-700 hover:text-cyan-700">
                                    <span>View Profile</span>
                                    <i class="ri-arrow-right-line"></i>
                                </a>

                                <button type="button"
                                   @click="$dispatch('open-booking-modal')"
                                   class="inline-flex items-center justify-center gap-2 rounded-full border border-cyan-700/30 bg-cyan-50/70 px-5 py-2.5 text-xs font-semibold text-cyan-700 transition hover:bg-cyan-100">
                                    <span>Book Dental Visit</span>
                                    <i class="ri-arrow-right-line"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>
</div>

