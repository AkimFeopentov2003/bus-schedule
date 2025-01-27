--
-- PostgreSQL database dump
--

-- Dumped from database version 14.15 (Debian 14.15-1.pgdg120+1)
-- Dumped by pg_dump version 17.2 (Ubuntu 17.2-1.pgdg24.04+1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: public; Type: SCHEMA; Schema: -; Owner: laravel
--

-- *not* creating schema, since initdb creates it


ALTER SCHEMA public OWNER TO laravel;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: buses; Type: TABLE; Schema: public; Owner: laravel
--

CREATE TABLE public.buses (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.buses OWNER TO laravel;

--
-- Name: buses_id_seq; Type: SEQUENCE; Schema: public; Owner: laravel
--

CREATE SEQUENCE public.buses_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.buses_id_seq OWNER TO laravel;

--
-- Name: buses_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: laravel
--

ALTER SEQUENCE public.buses_id_seq OWNED BY public.buses.id;


--
-- Name: cache; Type: TABLE; Schema: public; Owner: laravel
--

CREATE TABLE public.cache (
    key character varying(255) NOT NULL,
    value text NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache OWNER TO laravel;

--
-- Name: cache_locks; Type: TABLE; Schema: public; Owner: laravel
--

CREATE TABLE public.cache_locks (
    key character varying(255) NOT NULL,
    owner character varying(255) NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache_locks OWNER TO laravel;

--
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: laravel
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.failed_jobs OWNER TO laravel;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: laravel
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.failed_jobs_id_seq OWNER TO laravel;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: laravel
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- Name: job_batches; Type: TABLE; Schema: public; Owner: laravel
--

CREATE TABLE public.job_batches (
    id character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    total_jobs integer NOT NULL,
    pending_jobs integer NOT NULL,
    failed_jobs integer NOT NULL,
    failed_job_ids text NOT NULL,
    options text,
    cancelled_at integer,
    created_at integer NOT NULL,
    finished_at integer
);


ALTER TABLE public.job_batches OWNER TO laravel;

--
-- Name: jobs; Type: TABLE; Schema: public; Owner: laravel
--

CREATE TABLE public.jobs (
    id bigint NOT NULL,
    queue character varying(255) NOT NULL,
    payload text NOT NULL,
    attempts smallint NOT NULL,
    reserved_at integer,
    available_at integer NOT NULL,
    created_at integer NOT NULL
);


ALTER TABLE public.jobs OWNER TO laravel;

--
-- Name: jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: laravel
--

CREATE SEQUENCE public.jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.jobs_id_seq OWNER TO laravel;

--
-- Name: jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: laravel
--

ALTER SEQUENCE public.jobs_id_seq OWNED BY public.jobs.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: laravel
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO laravel;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: laravel
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.migrations_id_seq OWNER TO laravel;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: laravel
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: password_reset_tokens; Type: TABLE; Schema: public; Owner: laravel
--

CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_reset_tokens OWNER TO laravel;

--
-- Name: route_schedules; Type: TABLE; Schema: public; Owner: laravel
--

CREATE TABLE public.route_schedules (
    id bigint NOT NULL,
    route_id bigint NOT NULL,
    departure_time time(0) without time zone NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.route_schedules OWNER TO laravel;

--
-- Name: route_schedules_id_seq; Type: SEQUENCE; Schema: public; Owner: laravel
--

CREATE SEQUENCE public.route_schedules_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.route_schedules_id_seq OWNER TO laravel;

--
-- Name: route_schedules_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: laravel
--

ALTER SEQUENCE public.route_schedules_id_seq OWNED BY public.route_schedules.id;


--
-- Name: route_stops; Type: TABLE; Schema: public; Owner: laravel
--

CREATE TABLE public.route_stops (
    id bigint NOT NULL,
    route_id bigint NOT NULL,
    stop_id bigint NOT NULL,
    stop_order integer NOT NULL,
    travel_time integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.route_stops OWNER TO laravel;

--
-- Name: route_stops_id_seq; Type: SEQUENCE; Schema: public; Owner: laravel
--

CREATE SEQUENCE public.route_stops_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.route_stops_id_seq OWNER TO laravel;

--
-- Name: route_stops_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: laravel
--

ALTER SEQUENCE public.route_stops_id_seq OWNED BY public.route_stops.id;


--
-- Name: routes; Type: TABLE; Schema: public; Owner: laravel
--

CREATE TABLE public.routes (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    bus_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.routes OWNER TO laravel;

--
-- Name: routes_id_seq; Type: SEQUENCE; Schema: public; Owner: laravel
--

CREATE SEQUENCE public.routes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.routes_id_seq OWNER TO laravel;

--
-- Name: routes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: laravel
--

ALTER SEQUENCE public.routes_id_seq OWNED BY public.routes.id;


--
-- Name: sessions; Type: TABLE; Schema: public; Owner: laravel
--

CREATE TABLE public.sessions (
    id character varying(255) NOT NULL,
    user_id bigint,
    ip_address character varying(45),
    user_agent text,
    payload text NOT NULL,
    last_activity integer NOT NULL
);


ALTER TABLE public.sessions OWNER TO laravel;

--
-- Name: stops; Type: TABLE; Schema: public; Owner: laravel
--

CREATE TABLE public.stops (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.stops OWNER TO laravel;

--
-- Name: stops_id_seq; Type: SEQUENCE; Schema: public; Owner: laravel
--

CREATE SEQUENCE public.stops_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.stops_id_seq OWNER TO laravel;

--
-- Name: stops_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: laravel
--

ALTER SEQUENCE public.stops_id_seq OWNED BY public.stops.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: laravel
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.users OWNER TO laravel;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: laravel
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.users_id_seq OWNER TO laravel;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: laravel
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: buses id; Type: DEFAULT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.buses ALTER COLUMN id SET DEFAULT nextval('public.buses_id_seq'::regclass);


--
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- Name: jobs id; Type: DEFAULT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.jobs ALTER COLUMN id SET DEFAULT nextval('public.jobs_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: route_schedules id; Type: DEFAULT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.route_schedules ALTER COLUMN id SET DEFAULT nextval('public.route_schedules_id_seq'::regclass);


--
-- Name: route_stops id; Type: DEFAULT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.route_stops ALTER COLUMN id SET DEFAULT nextval('public.route_stops_id_seq'::regclass);


--
-- Name: routes id; Type: DEFAULT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.routes ALTER COLUMN id SET DEFAULT nextval('public.routes_id_seq'::regclass);


--
-- Name: stops id; Type: DEFAULT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.stops ALTER COLUMN id SET DEFAULT nextval('public.stops_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: buses; Type: TABLE DATA; Schema: public; Owner: laravel
--

COPY public.buses (id, name, created_at, updated_at) FROM stdin;
1	Автобус No11	2025-01-23 14:32:11	2025-01-23 14:32:11
2	Автобус No21	2025-01-23 14:32:11	2025-01-23 14:32:11
3	Автобус No33	2025-01-23 14:32:11	2025-01-23 14:32:11
4	Автобус No44	2025-01-23 14:32:11	2025-01-23 14:32:11
5	Автобус No55	2025-01-23 14:32:11	2025-01-23 14:32:11
6	Автобус No13	2025-01-23 14:32:11	2025-01-23 14:32:11
\.


--
-- Data for Name: cache; Type: TABLE DATA; Schema: public; Owner: laravel
--

COPY public.cache (key, value, expiration) FROM stdin;
\.


--
-- Data for Name: cache_locks; Type: TABLE DATA; Schema: public; Owner: laravel
--

COPY public.cache_locks (key, owner, expiration) FROM stdin;
\.


--
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: laravel
--

COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
\.


--
-- Data for Name: job_batches; Type: TABLE DATA; Schema: public; Owner: laravel
--

COPY public.job_batches (id, name, total_jobs, pending_jobs, failed_jobs, failed_job_ids, options, cancelled_at, created_at, finished_at) FROM stdin;
\.


--
-- Data for Name: jobs; Type: TABLE DATA; Schema: public; Owner: laravel
--

COPY public.jobs (id, queue, payload, attempts, reserved_at, available_at, created_at) FROM stdin;
\.


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: laravel
--

COPY public.migrations (id, migration, batch) FROM stdin;
1	0001_01_01_000000_create_users_table	1
2	0001_01_01_000001_create_cache_table	1
3	0001_01_01_000002_create_jobs_table	1
4	2025_01_23_101831_create_stops_table	1
5	2025_01_23_134358_create_buses_table	1
6	2025_01_23_134806_create_routes_table	1
7	2025_01_23_135200_create_route_stops_table	1
8	2025_01_23_135619_create_route_schedules_table	1
\.


--
-- Data for Name: password_reset_tokens; Type: TABLE DATA; Schema: public; Owner: laravel
--

COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: route_schedules; Type: TABLE DATA; Schema: public; Owner: laravel
--

COPY public.route_schedules (id, route_id, departure_time, created_at, updated_at) FROM stdin;
1	1	08:00:00	2025-01-23 14:32:11	2025-01-23 14:32:11
2	1	08:30:00	2025-01-23 14:32:11	2025-01-23 14:32:11
3	1	09:00:00	2025-01-23 14:32:11	2025-01-23 14:32:11
4	2	08:15:00	2025-01-23 14:32:11	2025-01-23 14:32:11
5	2	08:45:00	2025-01-23 14:32:11	2025-01-23 14:32:11
6	2	09:15:00	2025-01-23 14:32:11	2025-01-23 14:32:11
7	3	07:30:00	2025-01-23 14:32:11	2025-01-23 14:32:11
8	3	08:30:00	2025-01-23 14:32:11	2025-01-23 14:32:11
9	3	09:30:00	2025-01-23 14:32:11	2025-01-23 14:32:11
10	4	06:45:00	2025-01-23 14:32:11	2025-01-23 14:32:11
11	4	07:45:00	2025-01-23 14:32:11	2025-01-23 14:32:11
12	4	08:45:00	2025-01-23 14:32:11	2025-01-23 14:32:11
13	6	19:00:00	2025-01-23 14:32:11	2025-01-23 14:32:11
14	6	17:00:00	2025-01-23 14:32:11	2025-01-23 14:32:11
15	6	15:00:00	2025-01-23 14:32:11	2025-01-23 14:32:11
16	6	12:30:00	2025-01-23 14:32:11	2025-01-23 14:32:11
\.


--
-- Data for Name: route_stops; Type: TABLE DATA; Schema: public; Owner: laravel
--

COPY public.route_stops (id, route_id, stop_id, stop_order, travel_time, created_at, updated_at) FROM stdin;
1	1	1	1	0	2025-01-23 14:32:11	2025-01-23 14:32:11
2	1	2	2	10	2025-01-23 14:32:11	2025-01-23 14:32:11
3	1	3	3	20	2025-01-23 14:32:11	2025-01-23 14:32:11
4	2	3	1	0	2025-01-23 14:32:11	2025-01-23 14:32:11
5	2	2	2	10	2025-01-23 14:32:11	2025-01-23 14:32:11
6	2	1	3	20	2025-01-23 14:32:11	2025-01-23 14:32:11
7	3	4	1	0	2025-01-23 14:32:11	2025-01-23 14:32:11
8	3	5	2	15	2025-01-23 14:32:11	2025-01-23 14:32:11
9	4	6	1	0	2025-01-23 14:32:11	2025-01-23 14:32:11
10	4	7	2	20	2025-01-23 14:32:11	2025-01-23 14:32:11
11	4	8	3	35	2025-01-23 14:32:11	2025-01-23 14:32:11
12	6	1	1	0	2025-01-23 14:32:11	2025-01-23 14:32:11
13	6	2	2	12	2025-01-23 14:32:11	2025-01-23 14:32:11
14	6	3	3	24	2025-01-23 14:32:11	2025-01-23 14:32:11
15	6	4	4	45	2025-01-23 14:32:11	2025-01-23 14:32:11
16	6	5	5	58	2025-01-23 14:32:11	2025-01-23 14:32:11
17	6	6	6	70	2025-01-23 14:32:11	2025-01-23 14:32:11
\.


--
-- Data for Name: routes; Type: TABLE DATA; Schema: public; Owner: laravel
--

COPY public.routes (id, name, bus_id, created_at, updated_at) FROM stdin;
1	Рейс No11 до ул. Попова	1	2025-01-23 14:32:11	2025-01-23 14:32:11
2	Рейс No11 до ул. Пушкина	1	2025-01-23 14:32:11	2025-01-23 14:32:11
3	Рейс No21 до ул. Московская	2	2025-01-23 14:32:11	2025-01-23 14:32:11
4	Рейс No33 до ул. Первомайская	3	2025-01-23 14:32:11	2025-01-23 14:32:11
5	Рейс No44 до ул. Центральная	4	2025-01-23 14:32:11	2025-01-23 14:32:11
6	Рейс No13 до ул. Центральная	6	2025-01-23 14:32:11	2025-01-23 14:32:11
\.


--
-- Data for Name: sessions; Type: TABLE DATA; Schema: public; Owner: laravel
--

COPY public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) FROM stdin;
ll7KLUt6KSfqmtlDR1FfB9mepNkjoujkK2Eay6db	\N	172.18.0.1	Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36	YTozOntzOjY6Il90b2tlbiI7czo0MDoic0h1Y3VKYlJIUVVXVlplRGF2dUFLUUFTTFhtZGQ3WlZDcGdQazlTVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hcGkvZmluZC1idXMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19	1737974433
\.


--
-- Data for Name: stops; Type: TABLE DATA; Schema: public; Owner: laravel
--

COPY public.stops (id, name, created_at, updated_at) FROM stdin;
1	ул. Пушкина	2025-01-23 14:32:11	2025-01-23 14:32:11
2	ул. Ленина	2025-01-23 14:32:11	2025-01-23 14:32:11
3	ул. Попова	2025-01-23 14:32:11	2025-01-23 14:32:11
4	ул. Садовая	2025-01-23 14:32:11	2025-01-23 14:32:11
5	ул. Московская	2025-01-23 14:32:11	2025-01-23 14:32:11
6	ул. Центральная	2025-01-23 14:32:11	2025-01-23 14:32:11
7	ул. Куйбышева	2025-01-23 14:32:11	2025-01-23 14:32:11
8	ул. Первомайская	2025-01-23 14:32:11	2025-01-23 14:32:11
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: laravel
--

COPY public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at) FROM stdin;
\.


--
-- Name: buses_id_seq; Type: SEQUENCE SET; Schema: public; Owner: laravel
--

SELECT pg_catalog.setval('public.buses_id_seq', 5, true);


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: laravel
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- Name: jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: laravel
--

SELECT pg_catalog.setval('public.jobs_id_seq', 1, false);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: laravel
--

SELECT pg_catalog.setval('public.migrations_id_seq', 8, true);


--
-- Name: route_schedules_id_seq; Type: SEQUENCE SET; Schema: public; Owner: laravel
--

SELECT pg_catalog.setval('public.route_schedules_id_seq', 12, true);


--
-- Name: route_stops_id_seq; Type: SEQUENCE SET; Schema: public; Owner: laravel
--

SELECT pg_catalog.setval('public.route_stops_id_seq', 11, true);


--
-- Name: routes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: laravel
--

SELECT pg_catalog.setval('public.routes_id_seq', 5, true);


--
-- Name: stops_id_seq; Type: SEQUENCE SET; Schema: public; Owner: laravel
--

SELECT pg_catalog.setval('public.stops_id_seq', 8, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: laravel
--

SELECT pg_catalog.setval('public.users_id_seq', 1, false);


--
-- Name: buses buses_pkey; Type: CONSTRAINT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.buses
    ADD CONSTRAINT buses_pkey PRIMARY KEY (id);


--
-- Name: cache_locks cache_locks_pkey; Type: CONSTRAINT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.cache_locks
    ADD CONSTRAINT cache_locks_pkey PRIMARY KEY (key);


--
-- Name: cache cache_pkey; Type: CONSTRAINT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.cache
    ADD CONSTRAINT cache_pkey PRIMARY KEY (key);


--
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- Name: job_batches job_batches_pkey; Type: CONSTRAINT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.job_batches
    ADD CONSTRAINT job_batches_pkey PRIMARY KEY (id);


--
-- Name: jobs jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.jobs
    ADD CONSTRAINT jobs_pkey PRIMARY KEY (id);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: password_reset_tokens password_reset_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);


--
-- Name: route_schedules route_schedules_pkey; Type: CONSTRAINT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.route_schedules
    ADD CONSTRAINT route_schedules_pkey PRIMARY KEY (id);


--
-- Name: route_stops route_stops_pkey; Type: CONSTRAINT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.route_stops
    ADD CONSTRAINT route_stops_pkey PRIMARY KEY (id);


--
-- Name: routes routes_pkey; Type: CONSTRAINT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.routes
    ADD CONSTRAINT routes_pkey PRIMARY KEY (id);


--
-- Name: sessions sessions_pkey; Type: CONSTRAINT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);


--
-- Name: stops stops_pkey; Type: CONSTRAINT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.stops
    ADD CONSTRAINT stops_pkey PRIMARY KEY (id);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: jobs_queue_index; Type: INDEX; Schema: public; Owner: laravel
--

CREATE INDEX jobs_queue_index ON public.jobs USING btree (queue);


--
-- Name: sessions_last_activity_index; Type: INDEX; Schema: public; Owner: laravel
--

CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);


--
-- Name: sessions_user_id_index; Type: INDEX; Schema: public; Owner: laravel
--

CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);


--
-- Name: route_schedules route_schedules_route_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.route_schedules
    ADD CONSTRAINT route_schedules_route_id_foreign FOREIGN KEY (route_id) REFERENCES public.routes(id) ON DELETE CASCADE;


--
-- Name: route_stops route_stops_route_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.route_stops
    ADD CONSTRAINT route_stops_route_id_foreign FOREIGN KEY (route_id) REFERENCES public.routes(id) ON DELETE CASCADE;


--
-- Name: route_stops route_stops_stop_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.route_stops
    ADD CONSTRAINT route_stops_stop_id_foreign FOREIGN KEY (stop_id) REFERENCES public.stops(id) ON DELETE CASCADE;


--
-- Name: routes routes_bus_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: laravel
--

ALTER TABLE ONLY public.routes
    ADD CONSTRAINT routes_bus_id_foreign FOREIGN KEY (bus_id) REFERENCES public.buses(id) ON DELETE CASCADE;


--
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: laravel
--

REVOKE USAGE ON SCHEMA public FROM PUBLIC;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

