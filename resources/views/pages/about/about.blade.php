<div>
    <section class="relative overflow-hidden bg-[#f5fafc]">
        <div class="pointer-events-none absolute -right-24 -top-24 h-80 w-80 rounded-full border-[46px] border-sky-100/70"></div>
        <div class="pointer-events-none absolute -bottom-28 left-1/3 h-64 w-64 rounded-full border-[34px] border-white"></div>

        <div class="relative mx-auto grid max-w-7xl items-center gap-12 px-5 py-14 sm:px-6 sm:py-20 lg:grid-cols-[1.05fr_.95fr] lg:gap-16 lg:px-8 lg:py-24">
            <div>
                <div class="inline-flex items-center gap-2 border border-sky-100 bg-white px-3 py-2 text-xs font-semibold uppercase tracking-[0.16em] text-med-blue">
                    <i class="ri-hospital-line text-base"></i>
                    About Us · MediDENT Multicare Clinic
                </div>

                <h1 class="mt-6 max-w-2xl text-4xl font-bold leading-[1.15] tracking-tight text-med-navy sm:text-5xl lg:text-[3.5rem]">
                    Medical, diabetes and
                    <span class="text-med-blue">dental care</span>
                    under one roof.
                </h1>

                <p class="mt-6 max-w-xl text-base leading-8 text-slate-600">
                    MediDENT Multicare Clinic is a healthcare facility providing medical, diabetic and dental care to patients of all ages. Our experienced doctors, dentists and healthcare professionals work together to deliver comprehensive, compassionate care.
                </p>

                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ url('/#contact') }}"
                       class="inline-flex items-center gap-3 bg-med-blue px-6 py-3.5 text-sm font-semibold text-white transition hover:bg-sky-800">
                        Book an Appointment
                        <i class="ri-arrow-right-up-line text-lg"></i>
                    </a>

                    <a href="#doctors"
                       class="inline-flex items-center gap-2 border border-slate-300 bg-white px-6 py-3.5 text-sm font-semibold text-med-navy transition hover:border-med-blue hover:text-med-blue">
                        Meet Our Doctors
                        <i class="ri-arrow-down-line"></i>
                    </a>
                </div>

                <div class="mt-9 grid grid-cols-3 gap-4 border-t border-slate-200 pt-6">
                    <div>
                        <i class="ri-stethoscope-line text-xl text-med-blue"></i>
                        <p class="mt-2 text-sm font-semibold text-med-navy">Medical</p>
                    </div>

                    <div>
                        <i class="ri-heart-pulse-line text-xl text-med-red"></i>
                        <p class="mt-2 text-sm font-semibold text-med-navy">Diabetes</p>
                    </div>

                    <div>
                        <i class="ri-tooth-line text-xl text-cyan-700"></i>
                        <p class="mt-2 text-sm font-semibold text-med-navy">Dental</p>
                    </div>
                </div>
            </div>

            <div class="relative">
                <div class="absolute -right-3 -top-3 h-24 w-24 border border-sky-200 sm:-right-5 sm:-top-5 sm:h-32 sm:w-32"></div>

                <div class="relative border-[5px] border-white bg-white shadow-[0_20px_60px_rgba(18,50,74,0.12)]">
                    <img
                        src="{{ asset('images/hero-img.jpg') }}"
                        alt="MediDENT Multicare Clinic care team"
                        fetchpriority="high"
                        class="h-[320px] w-full object-cover sm:h-[410px] lg:h-[470px]"
                    >

                    <div class="absolute bottom-5 left-5 right-5 border border-white/60 bg-white/95 p-4 shadow-lg backdrop-blur sm:left-6 sm:right-auto sm:max-w-[260px]">
                        <div class="flex items-center gap-3">
                            <span class="grid h-11 w-11 shrink-0 place-items-center bg-sky-50 text-xl text-med-blue">
                                <i class="ri-user-heart-line"></i>
                            </span>
                            <div>
                                <p class="text-sm font-bold text-med-navy">Patient-first care</p>
                                <p class="mt-0.5 text-xs leading-5 text-slate-500">Listening, explaining and supporting every step.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-med-navy">
        <div class="mx-auto grid max-w-7xl grid-cols-2 divide-x divide-white/10 lg:grid-cols-4">
            <div class="px-5 py-8 text-center sm:px-8 sm:py-10">
                <p class="text-3xl font-bold tracking-tight text-white sm:text-4xl">5000+</p>
                <p class="mt-2 text-xs font-semibold uppercase tracking-[0.14em] text-cyan-300">Complete Cases</p>
            </div>

            <div class="px-5 py-8 text-center sm:px-8 sm:py-10">
                <p class="text-3xl font-bold tracking-tight text-white sm:text-4xl">15</p>
                <p class="mt-2 text-xs font-semibold uppercase tracking-[0.14em] text-cyan-300">Expert Staff</p>
            </div>

            <div class="border-t border-white/10 px-5 py-8 text-center sm:px-8 sm:py-10 lg:border-t-0">
                <p class="text-3xl font-bold tracking-tight text-white sm:text-4xl">3</p>
                <p class="mt-2 text-xs font-semibold uppercase tracking-[0.14em] text-cyan-300">Care Disciplines</p>
            </div>

            <div class="border-t border-white/10 px-5 py-8 text-center sm:px-8 sm:py-10 lg:border-t-0">
                <p class="text-3xl font-bold tracking-tight text-white sm:text-4xl">6</p>
                <p class="mt-2 text-xs font-semibold uppercase tracking-[0.14em] text-cyan-300">Days a Week</p>
            </div>
        </div>
    </section>

    <section class="bg-white py-16 sm:py-20 lg:py-24">
        <div class="mx-auto grid max-w-7xl items-center gap-12 px-5 sm:px-6 lg:grid-cols-[.9fr_1.1fr] lg:gap-16 lg:px-8">
            <div class="relative">
                <img
                    src="{{ asset('images/general-diseases.jpg') }}"
                    alt="Doctor consulting a patient at MediDENT"
                    loading="lazy"
                    decoding="async"
                    class="h-[340px] w-full object-cover sm:h-[440px]"
                >

                <div class="absolute -bottom-6 -right-3 hidden w-56 border border-slate-200 bg-white p-5 shadow-[0_18px_45px_rgba(18,50,74,0.12)] sm:block lg:-right-6">
                    <i class="ri-double-quotes-l text-3xl text-med-blue"></i>
                    <p class="mt-2 text-sm font-semibold leading-6 text-med-navy">
                        High-quality, compassionate care for optimal health and wellbeing.
                    </p>
                </div>
            </div>

            <div>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-med-red">
                    Our Story
                </p>

                <h2 class="mt-4 text-3xl font-bold leading-tight tracking-tight text-med-navy sm:text-4xl">
                    Comprehensive care, delivered with compassion.
                </h2>

                <p class="mt-5 text-base leading-8 text-slate-600">
                    MediDENT Multicare Clinic brings medical, diabetic and dental services together in one convenient place. Our team is dedicated to providing high-quality, compassionate care to patients and helping them achieve optimal health and wellbeing.
                </p>

                <p class="mt-4 text-sm leading-7 text-slate-500 sm:text-base sm:leading-8">
                    Whether you are visiting for a routine check-up, ongoing diabetes support or specialist dental treatment, we take the time to understand your needs and build a care plan that feels right for you.
                </p>

                <div class="mt-8 grid gap-4 sm:grid-cols-2">
                    <div class="flex gap-3 border border-slate-200 p-4">
                        <i class="ri-check-line mt-0.5 text-xl text-med-blue"></i>
                        <div>
                            <h3 class="text-sm font-semibold text-med-navy">Experienced team</h3>
                            <p class="mt-1 text-xs leading-5 text-slate-500">Qualified doctors, dentists and healthcare professionals.</p>
                        </div>
                    </div>

                    <div class="flex gap-3 border border-slate-200 p-4">
                        <i class="ri-check-line mt-0.5 text-xl text-med-blue"></i>
                        <div>
                            <h3 class="text-sm font-semibold text-med-navy">Connected care</h3>
                            <p class="mt-1 text-xs leading-5 text-slate-500">Medical, diabetes and dental services under one roof.</p>
                        </div>
                    </div>

                    <div class="flex gap-3 border border-slate-200 p-4">
                        <i class="ri-check-line mt-0.5 text-xl text-med-blue"></i>
                        <div>
                            <h3 class="text-sm font-semibold text-med-navy">Personal attention</h3>
                            <p class="mt-1 text-xs leading-5 text-slate-500">Care plans tailored to individual needs and goals.</p>
                        </div>
                    </div>

                    <div class="flex gap-3 border border-slate-200 p-4">
                        <i class="ri-check-line mt-0.5 text-xl text-med-blue"></i>
                        <div>
                            <h3 class="text-sm font-semibold text-med-navy">Clear guidance</h3>
                            <p class="mt-1 text-xs leading-5 text-slate-500">Understand your options and the next steps in your care.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="care" class="border-y border-slate-100 bg-[#f5fafc] py-16 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">
            <div class="max-w-2xl">
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-med-red">
                    What We Do
                </p>

                <h2 class="mt-3 text-3xl font-bold leading-tight tracking-tight text-med-navy sm:text-4xl">
                    Three specialties. One connected care experience.
                </h2>

                <p class="mt-4 text-sm leading-7 text-slate-500 sm:text-base">
                    From everyday healthcare to long-term condition management and complete dental care, our services are designed around you.
                </p>
            </div>

            <div class="mt-10 grid gap-5 lg:grid-cols-3">
                <article class="group flex h-full flex-col border border-slate-200 bg-white p-6 transition duration-300 hover:-translate-y-1 hover:border-sky-200 hover:shadow-[0_16px_40px_rgba(18,50,74,0.08)] sm:p-8">
                    <div class="flex items-start justify-between gap-4">
                        <span class="grid h-14 w-14 place-items-center bg-sky-50 text-2xl text-med-blue">
                            <i class="ri-stethoscope-line"></i>
                        </span>
                        <span class="text-4xl font-bold text-slate-100">01</span>
                    </div>

                    <h3 class="mt-6 text-xl font-bold text-med-navy">Medical Care</h3>

                    <p class="mt-3 flex-1 text-sm leading-7 text-slate-600">
                        General health check-ups, treatment for common illnesses and injuries, and management of chronic conditions such as hypertension, diabetes and asthma. We also provide vaccinations, health screenings and preventive care to help you maintain your health and wellbeing.
                    </p>

                    <a href="{{ url('/#contact') }}"
                       class="mt-6 inline-flex items-center gap-2 border-t border-slate-100 pt-4 text-sm font-semibold text-med-blue">
                        Book a consultation
                        <i class="ri-arrow-right-line transition group-hover:translate-x-1"></i>
                    </a>
                </article>

                <article class="group flex h-full flex-col border border-slate-200 bg-white p-6 transition duration-300 hover:-translate-y-1 hover:border-red-200 hover:shadow-[0_16px_40px_rgba(18,50,74,0.08)] sm:p-8">
                    <div class="flex items-start justify-between gap-4">
                        <span class="grid h-14 w-14 place-items-center bg-red-50 text-2xl text-med-red">
                            <i class="ri-heart-pulse-line"></i>
                        </span>
                        <span class="text-4xl font-bold text-slate-100">02</span>
                    </div>

                    <h3 class="mt-6 text-xl font-bold text-med-navy">Diabetic Care</h3>

                    <p class="mt-3 flex-1 text-sm leading-7 text-slate-600">
                        Regular blood sugar monitoring, dietary counselling, medication management and lifestyle recommendations to help you manage diabetes effectively. Our healthcare professionals work closely with you to develop a customised care plan tailored to your individual needs and goals.
                    </p>

                    <a href="{{ url('/#contact') }}"
                       class="mt-6 inline-flex items-center gap-2 border-t border-slate-100 pt-4 text-sm font-semibold text-med-red">
                        Plan your diabetes care
                        <i class="ri-arrow-right-line transition group-hover:translate-x-1"></i>
                    </a>
                </article>

                <article class="group flex h-full flex-col border border-slate-200 bg-white p-6 transition duration-300 hover:-translate-y-1 hover:border-cyan-200 hover:shadow-[0_16px_40px_rgba(18,50,74,0.08)] sm:p-8">
                    <div class="flex items-start justify-between gap-4">
                        <span class="grid h-14 w-14 place-items-center bg-cyan-50 text-2xl text-cyan-700">
                            <i class="ri-tooth-line"></i>
                        </span>
                        <span class="text-4xl font-bold text-slate-100">03</span>
                    </div>

                    <h3 class="mt-6 text-xl font-bold text-med-navy">Dental Care</h3>

                    <p class="mt-3 flex-1 text-sm leading-7 text-slate-600">
                        Preventive care including regular check-ups and cleanings, plus treatment for cavities, gum disease and tooth loss. We also offer cosmetic dental services such as teeth whitening, veneers and orthodontic treatment to help you achieve the smile you desire.
                    </p>

                    <a href="{{ url('/#contact') }}"
                       class="mt-6 inline-flex items-center gap-2 border-t border-slate-100 pt-4 text-sm font-semibold text-cyan-700">
                        Book a dental visit
                        <i class="ri-arrow-right-line transition group-hover:translate-x-1"></i>
                    </a>
                </article>
            </div>
        </div>
    </section>

    <section id="doctors" class="scroll-mt-24 bg-white py-16 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-5 md:flex-row md:items-end md:justify-between">
                <div class="max-w-2xl">
                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-med-red">
                        Our Team
                    </p>

                    <h2 class="mt-3 text-3xl font-bold leading-tight tracking-tight text-med-navy sm:text-4xl">
                        Our Expert Doctors
                    </h2>

                    <p class="mt-4 text-sm leading-7 text-slate-500 sm:text-base">
                        Experienced professionals dedicated to providing attentive, personalised care for you and your family.
                    </p>
                </div>

                <a href="{{ url('/#contact') }}"
                   class="inline-flex w-fit shrink-0 items-center gap-2 border-b border-med-blue pb-1 text-sm font-semibold text-med-blue transition hover:text-sky-800">
                    Book an appointment
                    <i class="ri-arrow-right-line"></i>
                </a>
            </div>

            <div class="mt-10 space-y-8">
                <article class="group overflow-hidden border border-slate-200 bg-white shadow-sm">
                    <div class="grid lg:grid-cols-[.42fr_.58fr]">
                        <div class="relative min-h-[320px] overflow-hidden bg-slate-100 lg:min-h-full">
                            <img
                                src="{{ asset('doctors/Dr.-Divya-Prakash.jpeg') }}"
                                alt="Dr. Divya Prakash"
                                loading="lazy"
                                decoding="async"
                                class="h-full w-full object-cover object-top transition duration-500 group-hover:scale-105"
                            >

                            <span class="absolute left-4 top-4 bg-white px-3 py-1.5 text-xs font-semibold text-med-blue shadow-sm">
                                Diabetologist & General Physician
                            </span>
                        </div>

                        <div class="p-6 sm:p-8 lg:p-10">
                            <p class="text-xs font-bold uppercase tracking-[0.2em] text-med-red">
                                Internal Medicine
                            </p>

                            <h3 class="mt-2 text-2xl font-bold tracking-tight text-med-navy sm:text-3xl">
                                Dr. Divya Prakash
                            </h3>

                            <p class="mt-2 text-sm font-semibold text-med-blue">
                                Diabetologist &amp; General Physician
                            </p>

                            <p class="mt-1 text-xs font-medium tracking-wide text-slate-500">
                                M.B.B.S., DNB, MNAMS, CCEBDM (Diabetology)
                            </p>

                            <p class="mt-5 text-sm leading-7 text-slate-600">
                                Dr. Divya Prakash has over 10 years of experience as a Diabetologist and General Physician. He is one of the best General Physicians in Delhi NCR at MediDENT Multicare Clinic, Shastri Nagar, Ghaziabad.
                            </p>

                            <p class="mt-3 text-sm leading-7 text-slate-600">
                                His expertise and dedication to patient care mean that every patient receives high-quality care and personalised attention during their visit.
                            </p>

                            <div class="mt-6 grid gap-4 border-t border-slate-100 pt-5 sm:grid-cols-2">
                                <div class="flex gap-3">
                                    <i class="ri-time-line mt-0.5 text-lg text-med-blue"></i>
                                    <div>
                                        <p class="text-xs font-semibold uppercase tracking-[0.12em] text-slate-400">MediDENT Timings</p>
                                        <p class="mt-1 text-sm leading-6 text-slate-600">Mon–Sat: 11:00 AM–12 Noon and 5:30 PM–8:30 PM<br>Sunday closed</p>
                                    </div>
                                </div>

                                <div class="flex gap-3">
                                    <i class="ri-map-pin-line mt-0.5 text-lg text-med-blue"></i>
                                    <div>
                                        <p class="text-xs font-semibold uppercase tracking-[0.12em] text-slate-400">Yashoda Clinics</p>
                                        <p class="mt-1 text-sm leading-6 text-slate-600">Raj Nagar Extension, Ghaziabad<br>12 PM–2 PM, 7 days</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-5 flex flex-wrap gap-3">
                                <a href="tel:+918800023032"
                                   class="inline-flex items-center gap-2 bg-med-navy px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-800">
                                    <i class="ri-phone-line"></i>
                                    +91-8800023032
                                </a>

                                <a href="tel:+911204169996"
                                   class="inline-flex items-center gap-2 border border-slate-300 px-4 py-2.5 text-sm font-semibold text-med-navy transition hover:border-med-blue hover:text-med-blue">
                                    <i class="ri-phone-line"></i>
                                    0120-4169996
                                </a>
                            </div>
                        </div>
                    </div>
                </article>

                <article class="group overflow-hidden border border-slate-200 bg-white shadow-sm">
                    <div class="grid lg:grid-cols-[.42fr_.58fr]">
                        <div class="relative min-h-[320px] overflow-hidden bg-slate-100 lg:order-last lg:min-h-full">
                            <img
                                src="{{ asset('doctors/Dr.-RatikaGupta.jpg') }}"
                                alt="Dr. Ratika Gupta"
                                loading="lazy"
                                decoding="async"
                                class="h-full w-full object-cover object-top transition duration-500 group-hover:scale-105"
                            >

                            <span class="absolute right-4 top-4 bg-white px-3 py-1.5 text-xs font-semibold text-cyan-700 shadow-sm">
                                Best Dentist, Dental Surgeon
                            </span>
                        </div>

                        <div class="p-6 sm:p-8 lg:p-10">
                            <p class="text-xs font-bold uppercase tracking-[0.2em] text-med-red">
                                Dental Care
                            </p>

                            <h3 class="mt-2 text-2xl font-bold tracking-tight text-med-navy sm:text-3xl">
                                Dr. Ratika Gupta
                            </h3>

                            <p class="mt-2 text-sm font-semibold text-cyan-700">
                                Best Dentist, Dental Surgeon
                            </p>

                            <p class="mt-1 text-xs font-medium tracking-wide text-slate-500">
                                B.D.S, M.D.S
                            </p>

                            <p class="mt-5 text-sm leading-7 text-slate-600">
                                Dr. Ratika Gupta has over 12 years of experience as a Dental Surgeon in Ghaziabad and Delhi NCR. She specialises in Pediatric and Preventive Dentistry, General Dentistry, Cosmetic Dentistry and Dental Implants.
                            </p>

                            <p class="mt-3 text-sm leading-7 text-slate-600">
                                Her knowledge and experience allow her to provide comprehensive dental care to patients of all ages, with the highest quality treatment and a comfortable experience.
                            </p>

                            <div class="mt-6 grid gap-4 border-t border-slate-100 pt-5 sm:grid-cols-2">
                                <div class="flex gap-3">
                                    <i class="ri-time-line mt-0.5 text-lg text-cyan-700"></i>
                                    <div>
                                        <p class="text-xs font-semibold uppercase tracking-[0.12em] text-slate-400">Timings</p>
                                        <p class="mt-1 text-sm leading-6 text-slate-600">Monday–Saturday: 11 AM–1 PM and 5 PM–8 PM<br>Sunday closed</p>
                                    </div>
                                </div>

                                <div class="flex gap-3">
                                    <i class="ri-tooth-line mt-0.5 text-lg text-cyan-700"></i>
                                    <div>
                                        <p class="text-xs font-semibold uppercase tracking-[0.12em] text-slate-400">Specialities</p>
                                        <p class="mt-1 text-sm leading-6 text-slate-600">Pediatric &amp; preventive, cosmetic and implant dentistry</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-5 flex flex-wrap gap-3">
                                <a href="tel:+918290582582"
                                   class="inline-flex items-center gap-2 bg-cyan-700 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-cyan-800">
                                    <i class="ri-phone-line"></i>
                                    +91-8290582582
                                </a>

                                <a href="{{ url('/#contact') }}"
                                   class="inline-flex items-center gap-2 border border-slate-300 px-4 py-2.5 text-sm font-semibold text-med-navy transition hover:border-cyan-700 hover:text-cyan-700">
                                    Book a dental visit
                                    <i class="ri-arrow-right-line"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>
</div>
