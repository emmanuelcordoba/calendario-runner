import React, { useEffect, useState } from 'react';
import { Link } from '@inertiajs/react';
import { Edition } from '@/types';
import moment from 'moment';

export default function RaceItemList({ edition }: { edition: Edition }) {

    return (
        <Link
            href={route('home.races.editions.show', [edition.race.slug, moment(edition.start_date, 'YYYY-MM-DD').format('Y')])}
            className="list-group-item list-group-item-action"
        >
            <div className="row">
                <div className="col-2">
                    <img className="img-fluid" src={edition.race.image ?? '/images/logo.png'} alt="" />
                </div>
                <div className="col-10">
                    <div className="d-flex justify-content-between">
                        <h5 className="mb-1">{edition.race.name}</h5>
                        {edition.start_date === edition.end_date ? (
                            <small>{moment(edition.start_date, 'YYYY-MM-DD').format('D/M ')}</small>
                        ) : (
                            <small>
                                {moment(edition.start_date, 'YYYY-MM-DD').format('D/M ')} - {moment(edition.end_date, 'YYYY-MM-DD').format('D/M ')}
                            </small>
                        )}
                    </div>
                    <p className="mb-1">{edition.distances.join(' - ')}</p>
                    <small>{edition.race.discipline.name}</small>
                </div>
            </div>
        </Link>
    );
}
