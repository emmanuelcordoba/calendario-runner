import { Head } from '@inertiajs/react';
import { Edition, PageProps } from '@/types';
import HomeLayout from '@/layouts/home-layout';
import moment from 'moment';
import {useEffect, useState} from "react";

export default function ShowEdition({ auth, edition }: PageProps<{ edition: Edition }>) {
    const [imageUrl, setImageUrl] = useState<string>('/images/logo.png');

    useEffect(() => {
        if (edition.image) {
            setImageUrl(edition.image);
            return;
        }
        if (edition.race.image) {
            setImageUrl(edition.race.image);
            return;
        }
    }, []);


    return (
        <HomeLayout user={auth.user}>
            <Head title="Carrera" />
            <div className="card mb-4">
                <div className="card-body">
                    <h2 className="card-title">{edition.race.name}</h2>
                    <div className="row">
                        <div className="col-md-8 col-lg-9 col-12">
                            <p className="">{edition.race.description}</p>
                            <dl className="">
                                <div className="pt-2">
                                    <dt className="">Fecha</dt>
                                    <dd className="mt-2">
                                        {moment(edition.start_date, 'YYYY-MM-DD').format('D/M ')} al{' '}
                                        {moment(edition.end_date, 'YYYY-MM-DD').format('D/M ')} del{' '}
                                        {moment(edition.start_date, 'YYYY-MM-DD').format('YYYY ')}
                                    </dd>
                                </div>
                                <div className="pt-2">
                                    <dt className="">Lugar</dt>
                                    <dd className="mt-2">{edition.race.final_place}</dd>
                                </div>
                                <div className="pt-2">
                                    <dt className="">Disciplina</dt>
                                    <dd className="mt-2">{edition.race.discipline.name}</dd>
                                </div>
                                <div className="pt-2">
                                    <dt className="">Distancias</dt>
                                    <dd className="mt-2">{edition.distances.join(' - ')}</dd>
                                </div>
                            </dl>
                            <div className="">
                                <dt className="">Enlaces</dt>
                                <dd className="d-flex mt-2 gap-2">
                                    {edition.race.links?.map((link) => (
                                        <a href={link.url} key={link.id} target="_blank" className="link-underline link-underline-opacity-0">
                                            {link.type}
                                        </a>
                                    ))}
                                </dd>
                            </div>
                        </div>
                        <div className="col-md-4 col-lg-3 col-12">
                            <img src={imageUrl} className="img-fluid" alt="Logo de Imagen" />
                        </div>
                    </div>
                    <button type="button" onClick={() => history.back()} className="btn btn-outline-primary mt-2">
                        Volver
                    </button>
                </div>
            </div>
        </HomeLayout>
    );
}
